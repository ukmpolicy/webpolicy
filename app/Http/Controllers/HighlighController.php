<?php

namespace App\Http\Controllers;

use App\Models\Highligh;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HighlighController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $dir = 'uploads/library/';
            $file->move($dir, $filename);

            $source = new Source();
            $source->path = $filename;
            $source->description = $file->getClientOriginalName();
            $source->type = 0;
            $source->save();

            // Create Highligh
            $highligh = new Highligh();
            $highligh->title = strtolower($request->title);
            $highligh->subtitle = strtolower($request->subtitle);
            $highligh->text_button = strtolower($request->text_button);
            $highligh->url_button = $request->url_button;
            $highligh->thumbnail = $source->id;
            $highligh->save();

            return redirect()->route('article')->with('success', 'Sorotan berhasil ditambahkan');
        }
        return redirect()->route('article')->with('failed', 'Sorotan gagal ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                $dir = 'uploads/library/';
                $file->move($dir, $filename);
                
                $source = Source::find($highligh->thumbnail);
                if (file_exists('/uploads/library/'.$source->path)) {
                    unlink('/uploads/library/'.$source->path);
                }
                $source->delete();
    
                $source = new Source();
                $source->path = $filename;
                $source->description = $file->getClientOriginalName();
                $source->type = 0;
                $source->save();
                $highligh->thumbnail = $source->id;
    
                
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
            $source = Source::find($highligh->thumbnail);
            if (file_exists('/uploads/library/'.$source->path)) {
                unlink('/uploads/library/'.$source->path);
            }
            $source->delete();
            $highligh->delete();
            return redirect()->route('article')->with('success', 'Sorotan berhasil dihapuskan');
        }
        return redirect()->route('article')->with('failed', 'Sorotan gagal dihapuskan');
    }
}
