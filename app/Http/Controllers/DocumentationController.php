<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Galery;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentationController extends Controller
{
    public function index(Request $request) {
        $data['events'] = $this->getEvents($request); 
        // dd($data['events']);
        return view('admin.pages.documentation.index', $data);
    }

    public function getEvents(Request $request) {
        $events = Event::where('type', 1);

        if ($request->search) {
            $events->where('name', 'like', '%'.$request->search.'%');
        }

        return $events->get();
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
