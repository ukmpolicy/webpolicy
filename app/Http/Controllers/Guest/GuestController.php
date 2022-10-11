<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Division;
use App\Models\Galery;
use App\Models\Highligh;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Program;
use App\Models\Role;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
        $officers = $this->getDOfficer(Officer::where('role', 0));
        // dd($officers->toArray());
        $generalDivision = Division::where('name', 'umum')->first();
        $general = $this->getDOfficer(Officer::where('division_id', $generalDivision->id));
        $officers = $general->merge($officers);
        $data['officers'] = $officers;
        $data['divisions'] = Division::all();
        $data['highlighs'] = Highligh::select(
            'highlighs.id', 'title', 'subtitle', 'sources.path as thumbnail', 'text_button', 'url_button'
            )->join('sources', 'highlighs.thumbnail', '=', 'sources.id')->get();
        $data['roles'] = ['ketua', 'sekretaris', 'bendahara', 'anggota'];
        return view('guest.pages.home.home', $data);
    }

    public function profile() {
        return view('guest.pages.introduction.introduction');
    }

    public function registerMembers() {
        $file = file_get_contents(public_path('members.json'));
        $data = json_decode($file, true);
        // dd($data);
        $members = [];
        foreach ($data as $fields) {
            $members[] = Member::create($fields);
        }
    }

    public function detailDivision(Request $request, $division) {
        $division = Division::where('name', $division)->first();
        $officers = $this->getDOfficer(Officer::where('division_id', $division->id));
        $data['division'] = $division;
        $data['officers'] = $officers;
        $data['roles'] = ['ketua', 'sekretaris', 'bendahara', 'anggota'];
        $data['programs'] = Program::where('division_id', $division->id)->get();
        return view('guest.pages.structural_division.structural_division', $data);
    }

    private function getDOfficer($o) {
        return $o->select('officers.id', 
        'members.name', 'divisions.name as division', 'role', 'period_start_at', 'period_end_at', 'members.photo'
        )->join('members', 'officers.member_id', '=', 'members.id')
        ->join('divisions', 'officers.division_id', '=', 'divisions.id')
        ->get();
    }

    public function articles(Request $request) {
        $maxArticles = 8;
        if ($request->max) {
            if ((int)$request->max > $maxArticles) {
                $maxArticles = (int)$request->max;
            }
        }
        $articles = Article::where('thumbnail', '!=', NULL)
        ->where('is_public', 1);

        if ($request->category) {
            $category = Category::where('type', 0)
            ->where('name', $request->category)
            ->first();

            if ($category) {
                $articles = $articles->where('category_id', $category->id);
            }
        }
        $data['count'] = $articles->count();
        $articles = $articles->get()->reverse()->take($maxArticles);
        $data['articles'] = array_map(function($v) {
            // $v['creator'] = User::find($v['creator_id'])->toArray();
            $v['category'] = Category::find($v['category_id'])->toArray();
            // $v['thumbnail'] = Source::find($v['thumbnail'])->toArray();
            return $v;
        }, $articles->toArray());
        return view('guest.pages.article.articles', $data);
    }

    public function documentation() {
        $events = Category::where('type', 1)->get();
        $data['events'] = $events;
        $data['documentations'] = $this;
        return view('guest.pages.documentation.documentation', $data);
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
        $data = Article::where('slug', $slug)->first();
        if ($data) {
            if (!$data->is_public) {
                return redirect()->route('mail.articles');
            }
            $data = $data->toArray();
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
            return view('guest.pages.article.article', $data);
        }
        return redirect()->route('main.articles');
    }
}
