<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Division;
use App\Models\Galery;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Program;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\ArrayList;

class HomeController extends Controller
{
    public function index() {
        $officers = $this->getDOfficer(Officer::where('role', 0));
        $generalDivision = Division::where('name', 'umum')->first();
        $general = $this->getDOfficer(Officer::where('division_id', $generalDivision->id));
        $officers = $general->merge($officers);
        $data['officers'] = $officers;
        $data['roles'] = ['ketua', 'sekretaris', 'bendahara', 'anggota'];
        return view('user.home', $data);
    }

    public function detailDivision(Request $request, $division) {
        $division = Division::where('name', $division)->first();
        $officers = $this->getDOfficer(Officer::where('division_id', $division->id));
        $data['officers'] = $officers;
        $data['roles'] = ['ketua', 'sekretaris', 'bendahara', 'anggota'];
        $data['programs'] = Program::where('division_id', $division->id)->get();
        return view('user.structural_division', $data);
    }

    private function getDOfficer($o) {
        return $o->select('officers.id', 
        'members.name', 'divisions.name as division', 'role', 'period_start_at', 'period_end_at', 'sources.path as profile_image'
        )->join('members', 'officers.member_id', '=', 'members.id')
        ->join('divisions', 'officers.division_id', '=', 'divisions.id')
        ->join('sources', 'members.profile_picture', '=',  'sources.id')
        ->get();
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
        $events = Category::where('type', 1)->get();
        $data['events'] = $events;
        $data['documentations'] = $this;
        return view('user.documentations', $data);
    }

    public function getDocumentation($event_id) {
        $event = Category::find($event_id);
        $docs = [];
        if ($event) {
            $docs = Galery::where('category_id', $event->id)
            ->select('galeries.id', 'galeries.description', 'galeries.created_at', 'sources.path', 'sources.type')
            ->join('sources', 'galeries.source_id', '=', 'sources.id')
            ->get();
        }
        return $docs;
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
            $bulan = $bulan[(int)date('m', $time) - 1];
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
