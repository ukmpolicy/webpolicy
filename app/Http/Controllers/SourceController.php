<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SourceController extends Controller
{
    public function index() {
        // dd(Auth::user()->id);
        if (Auth::user()->level == 3) {
            $data['sources'] = Source::all()->reverse();
        }else {
            $data['sources'] = Source::where('author_id', Auth::user()->id)->get()->reverse();
        }
        return view('admin.pages.sources.index', $data);
    }

    public function store(Request $request) {
        $rules = $request->rules;
        // return response()->json($rules);
        $val = Validator::make($request->all(), [
            'file_source' => $rules
        ]);

        if ($val->fails()) {
            return response()->json([
                'message' => 'invalid field',
                'body' => $val->errors()
            ], 403);
        }
        // dd($val->errors());
        if (($file = $request->file('file_source'))) {
            $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
            $dir = 'uploads/library/';
            $file->move($dir, $filename);

            // dd($file);

            $mime = explode('/',$file->getClientMimeType());

            $source = new Source();
            $source->path = $dir.$filename;
            $source->description = $file->getClientOriginalName();
            if ($request->user_id) {
                $source->author_id = $request->user_id;
            }
            $source->type = ($mime[0] == 'image') ? 0 : 1;
            $source->save();

            return response()->json([
                "message" => "Berhasil mengunggah!",
                "body" => $source->toArray(),
            ]);
        }
        return response()->json([
            "message" => "Telah terjadi kesalahan!",
            "body" => [],
        ], 500);
    }

    public function show($id) {
        $source = Source::find($id);

        if ($source) {
            return response()->json([
                "message" => "Success",
                "body" => $source->toArray(),
            ]);
        }
        return response()->json([
            "message" => "Source tidak ditemukan",
            "body" => null,
        ], 404);
    }

    public function destroy($id) {
        $source = Source::find($id);
        if ($source) {
            if (file_exists($source->path)) {
                unlink($source->path);
            }
            $temp = $source;
            $source->delete();
            return redirect()->route('library')->with('success', 'File '.$temp->description.' berhasil dihapus');
        }
        return redirect()->route('library')->with('failed', 'File tidak ditemukan');
    }
}
