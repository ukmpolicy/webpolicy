<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Division;
use App\Models\Galery;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $officers = [];
        if (!Officer::all()->isEmpty()) {
            $devisiUmum = Division::where('name', 'umum')->first();
            $umum = Officer::where('division_id', $devisiUmum->id)->get()->toArray();
            $other = Officer::where('role', 0)->get()->toArray();
            $officers = array_merge($umum, $other);
            $officers = array_map(function($v) {
                $v['member'] = Member::find($v['member_id'])->toArray();
                if (!is_null($v['member']['profile_picture'])) {
                    // dd(Source::find($v['member']['profile_picture']));
                    $v['member']['profile_picture'] = Source::find($v['member']['profile_picture'])->toArray();
                }
                $v['role'] = $this->getRole($v['role']);
                $v['division'] = Division::find($v['division_id'])->name;
                return $v;
            }, $officers);
            $rows = [];
            foreach ($officers as $i => $officer) {
                if (!in_array($officer['id'], $rows)) {
                    $rows[] = $officer['id'];
                }else {
                    unset($officers[$i]);
                }
            }
        }
        // dd($officers);
        $data['officers'] = $officers;
        return view('user.home', $data);
    }
    
    public function articles(Request $request) {
        $maxArticles = 8;
        if ($request->max) {
            if ((int)$request->max > $maxArticles) {
                $maxArticles = (int)$request->max;
            }
        }
        $articles = Article::all()->reverse();
        if ($request->category) {
            $category = Category::where('type', 0)->where('name', $request->category)->first();
            if ($category) {
                $articles = Article::where('category_id', $category->id)->get()->reverse();
            }
        }
        $data['count'] = $articles->count();
        $articles = $articles->take($maxArticles);
        $data['articles'] = array_map(function($v) {
            $v['creator'] = User::find($v['creator_id'])->toArray();
            $v['category'] = Category::find($v['category_id'])->toArray();
            $v['thumbnail'] = Source::find($v['thumbnail'])->toArray();
            return $v;
        }, $articles->toArray());
        return view('user.articles', $data);
    }
    
    public function documentation() {
        $events = Category::where('type', 1)->get()->toArray();
        $data['events'] = array_map(function($v) {
            $docs = Galery::where('category_id', $v['id'])->get()->toArray();
            $docs = array_map(function($v) {
                $v['source'] = Source::find($v['source_id']);
                return $v;
            }, $docs);
            $v['docs'] = $docs;
            return $v;
        }, $events);
        return view('user.documentations', $data);
    }

    public function article($slug) {
        $data = Article::where('slug', $slug)->first()->toArray();
        if ($data) {
            $data['thumbnail'] = Source::find($data['thumbnail']);
            $data['creator'] = User::find($data['creator_id']);
            $data['category'] = Category::find($data['category_id']);
            $bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            $time = strtotime($data['created_at']);
            $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $bulan = $bulan[(int)date('m', $time)];
            $hari = $hari[(int)date('N', $time)-1];
            // dd($hari);
            $data['created_at'] = $hari.date(', d ', $time) . $bulan. date(' Y H:i', $time);
            return view('user.article', $data);
        }
        return redirect()->route('main.articles');
    }

    public function getRole($role) {
        if ($role == 0) $role = 'ketua';
        if ($role == 1) $role = 'sekretaris';
        if ($role == 2) $role = 'bendahara';
        if ($role == 3) $role = 'anggota';
        return $role;
    }
}
