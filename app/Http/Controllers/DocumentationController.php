<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Galery;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentationController extends Controller
{
    public function index() {
        $categories = Category::where('type', 1)->get()->reverse()->toArray();
        $data['events'] = array_map(function($v) {
            $documenters = Galery::where('category_id', $v['id'])->get()->reverse()->toArray();
            $documenters = array_filter($documenters, function($v) {
                // if (empty($documenters)) dd($v);
                if (!is_null($v['source_id'])) return $v;
            });
            $v['documenters'] = array_map(function($v) {
                $v['source'] = Source::find($v['source_id'])->toArray();
                unset($v['source_id']);
                return $v;
            }, $documenters);
            return $v;
        }, $categories);     

        // dd($data['events']);
        return view('admin.pages.documentation.index', $data);
    }

    public function storeEvent(Request $request) {
        $this->validate($request, [
            "name" => "required",
        ]);
        $category = new Category();
        $category->name = strtolower($request->name);
        $category->type = 1;
        $category->save();

        return redirect()->route('documentation');
    }

    public function storeDocumenter(Request $request) {
        $val = Validator::make($request->all(), [
            "source_id" => 'required|exists:sources,id',
            "description" => 'required',
            "category_id" => 'required|exists:categories,id',
        ]);
        if ($val->fails()) {
            return response()->json([
                'message' => "Invalid field",
                "body" => $val->errors(),
            ], 403);
        }
        $source = new Galery;
        $source->source_id = $request->source_id;
        $source->description = strtolower($request->description);
        $source->category_id = $request->category_id;
        $source->save();
        
        return response()->json([
            'message' => "Dokumenter berhasil di tambahkan",
            "body" => $source->toArray(),
        ]);
    }

    public function destroyDocumenter(Request $request, $event_id, $documenter_id) {
        $category = Category::find($event_id);
        $galery = Galery::find($documenter_id);
        if ($category && $galery) {
            // $temp = $galery;
            $galery->delete();
            return redirect()->route('documentation')->with('success', 'Dokumenter berhasil dihapus');
        }
        return redirect()->route('documentation')->with('error', 'Dokumenter gagal dihapus');
    }
    
    public function destroyEvent(Request $request, $event_id) {
        $category = Category::find($event_id);
        if ($category) {
            // $temp = $galery;
            $category->delete();
            return redirect()->route('documentation')->with('success', 'Acara berhasil dihapus');
        }
        return redirect()->route('documentation')->with('error', 'Acara gagal dihapus');
    }
}
