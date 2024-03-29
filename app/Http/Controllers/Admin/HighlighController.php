<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highligh;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HighlighController extends Controller
{

    public function store(Request $request)
    {
        $val = Validator::make($request->all(), [
            'title' => "required|string",
            'subtitle' => "required|string",
            'text_button' => "required|string",
            'url_button' => "required|string",
            'thumbnail' => "required",
        ]);

        if ($val->fails()) {
            return redirect()->route('article')->with('failed', 'Sorotan gagal ditambahkan');
        }

        $file = $request->file('thumbnail');
        if ($file) {
            $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
            $dir = 'uploads/';
            $file->move($dir, $filename);

            // $source = new Source();
            // $source->path = $filename;
            // $source->description = $file->getClientOriginalName();
            // $source->type = 0;
            // $source->save();

            // Create Highligh
            $highligh = new Highligh();
            $highligh->title = strtolower($request->title);
            $highligh->subtitle = strtolower($request->subtitle);
            $highligh->text_button = strtolower($request->text_button);
            $highligh->url_button = $request->url_button;
            $highligh->thumbnail = $filename;
            $highligh->save();

            return redirect()->route('article')->with('success', 'Sorotan berhasil ditambahkan');
        }
        return redirect()->route('article')->with('failed', 'Sorotan gagal ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $val = Validator::make($request->all(), [
            'title' => "required|string",
            'subtitle' => "required|string",
            'text_button' => "required|string",
            'url_button' => "required|string",
        ]);

        if ($val->fails()) {
            return redirect()->route('article')->with('failed', 'Perubahan gagal disimpan');
        }

        $highligh = Highligh::find($id);
        if ($highligh) {

            $file = $request->file('thumbnail');
            if ($file) {
                $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
                $dir = 'uploads/';
                $file->move($dir, $filename);
                
                // $source = Source::find($highligh->thumbnail);
                if (file_exists('/uploads/'.$highligh->thumbnail)) {
                    unlink('/uploads/'.$highligh->thumbnail);
                }
                // $source->delete();
    
                // $source = new Source();
                // $source->path = $filename;
                // $source->description = $file->getClientOriginalName();
                // $source->type = 0;
                // $source->save();
                $highligh->thumbnail = $filename;
    
                
            }
            $highligh->title = strtolower($request->title);
            $highligh->subtitle = strtolower($request->subtitle);
            $highligh->text_button = strtolower($request->text_button);
            $highligh->url_button = $request->url_button;
            $highligh->save();
            return redirect()->route('article')->with('success', 'Perubahan berhasil disimpan');
        }
        return redirect()->route('article')->with('success', 'Perubahan gagal disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $highligh = Highligh::find($id);
        if ($highligh) {
            if (file_exists('/uploads/'.$highligh->thumbnail)) {
                unlink('/uploads/'.$highligh->thumbnail);
            }
            $highligh->delete();
            return redirect()->route('article')->with('success', 'Sorotan berhasil dihapuskan');
        }
        return redirect()->route('article')->with('failed', 'Sorotan gagal dihapuskan');
    }
}
