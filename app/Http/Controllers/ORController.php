<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ORDocument;
use App\Models\Setting;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

// use Barryvdh\DomPDF\Facade\PDF;

class ORController extends Controller
{
    public function index() {
        $data['settings'] = [];
        foreach (Setting::all() as $s) {
            $data['settings'][$s->key] = $s->value;
        }
        return view('user.open_recruitment.index', $data);
    }
    
    public function viewForm() {
        return view('user.open_recruitment.form');
    }
    public function orManager(Request $request) {
        $members = $this->getMembers($request);
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($members->count()/$perPage);
        $data['members'] = $members;
        $data['status'] = MemberController::$status;
        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;
        
        return view('admin.pages.or_manager.index', $data);
    }

    public function store(Request $request) {
        $vals = [
            'photo' => 'required|exists:sources,id',
            'proof_pkkmb' => 'required|exists:sources,id',
            "nim" => "required|unique:members,nim",
            "name" => "required",
            "address" => "required",
            "phone_number" => "required",
            "email" => "required|email",
            "major" => "required",
            "study_program" => "required",
            "interested_in" => "required",
            "born_at" => "required",
            "birth_place" => "required"
        ];
        if ($request->certificate) {
            $vals['certificate'] = 'exists:sources,id';
        }
        $this->validate($request, $vals);
        
        $member = new Member();
        $member->nim = $request->nim;
        $member->profile_picture = $request->photo;
        $member->name = strtolower($request->name);
        $member->address = strtolower($request->address);
        $member->phone_number = $request->phone_number;
        $member->email = strtolower($request->email);
        $member->major = strtolower($request->major);
        $member->study_program = strtolower($request->study_program);
        $member->interested_in = strtolower($request->interested_in);
        $member->born_at = strtolower($request->born_at);
        $member->birth_place = $request->birth_place;
        $member->joined_at = date('Y');
        $member->save();

        $or_doc = new ORDocument();
        $or_doc->member_id = $member->id;
        if ($request->certificate) $or_doc->certificate = $request->certificate;
        $or_doc->proof_pkkmb = $request->proof_pkkmb;
        $or_doc->save();

        // return response()->download($pathToFile, $name, $headers);
        return redirect()->route('open-recruitment.proof', ['nim' => $member->nim]);
    }

    public function proof($nim) {
        $member = Member::where('nim', $nim)->first();
        if ($member) {
            $doc = ORDocument::where('member_id', $member->id)->first();
            if ($doc) {
                $data = array_merge($member->toArray(), $doc->toArray());
                $data['profile_picture'] = Source::find($data['profile_picture'])->path;
                // $data['certificate'] = Source::find($data['certificate'])->path;
                // $data['proof_pkkmb'] = Source::find($data['proof_pkkmb'])->path;

                return view('user.open_recruitment.proof', $data);
            }
        }
        return redirect()->route('main.home');
    }

    public function check($nim) {
        $member = Member::where('nim', $nim)->first();
        if ($member) {
            $doc = ORDocument::where('member_id', $member->id)->first();
            if ($doc) {
                $data = array_merge($member->toArray(), $doc->toArray());
                // dd($data);
                $data['profile_picture'] = Source::find($data['profile_picture'])->path;
                $data['certificate'] = Source::find($data['certificate'])->path;
                $data['proof_pkkmb'] = Source::find($data['proof_pkkmb'])->path;

                return view('user.open_recruitment.check', $data);
            }
        }
        return redirect()->route('main.home');
    }

    public function orDone($id) {
        $member = Member::findOrFail($id);
        $member->store_document = ($member->store_document) ? null : date('Y-m-d H:i:s');
        $member->save();
        return redirect()->back();
    }

    public function downloadDataOR(Request $request) {
        $request->search = '';
        $data['members'] = $this->getMembers($request);
        return view('admin.pages.member.new_members', $data);
    }

    public function recruitment() {
        return view('user.recruitment.form');
    }
    
    public function recruitmentSuccess() {
        if (!session('success')) {
            return redirect('main.home');
        }
        return view('user.recruitment.done');
    }

    public function initSettings() {
        $data = [
            "or_setting_status" => 0,
            "or_setting_start" => time(),
            "or_setting_end" => time(),
        ];

        foreach ($data as $k => $v) {
            if (!Setting::where('key', $k)->first()) {
                $s = new Setting();
                $s->key = $k;
                $s->value = $v;
                $s->save();
            }
        }
    }
    public function viewSettings() {
        $this->initSettings();
        $data = [];
        foreach (Setting::all() as $s) {
            $data[$s->key] = $s->value;
        }
        return view('admin.pages.or_manager.settings', $data);
    }

    public function saveSettings(Request $request) {
        $this->validate($request, [
            'or_setting_status' => 'required',
            'or_setting_start' => 'required|date_format:Y-m-d\TH:i:s',
            'or_setting_end' => 'required|date_format:Y-m-d\TH:i:s',
        ]);
        
        foreach ($request->only([
            'or_setting_status',
            'or_setting_start',
            'or_setting_end',
        ]) as $k => $v) {
            $s = Setting::where('key', $k)->first();
            $s->value = $v;
            $s->save();
        }

        return redirect()->back()->with('success', 'Perubahan berhasil disimpan');
    }
    
    public function reset() {
        DB::update('update members set status = 1 where status = 0 and store_document != null');
        DB::delete('delete from members where status = 0');
        return redirect()->back()->with('success', 'Anggota baru berhasil dipindahkan ke anggota tetap');
    }

    public function getMembers(Request $request) {
        $data['members'] = [];
        $members = Member::where('status', 0);

        // Status Berkas
        if ($request->sb == 'd') {
            // If Done
            $members = $members->where('store_document', '!=', null);
        }else if ($request->sb == 'ny') {
            // If Not Yet
            $members = $members->where('store_document', null);
        }
        if ($request->search) {
            $members = $members->where('name', 'like', '%'. $request->search . '%')
            ->orWhere('nim', 'like', '%'. $request->search . '%')
            ->orWhere('major', 'like', '%'. $request->search . '%')
            ->orWhere('phone_number', 'like', '%'. $request->search . '%');
        }

        return $members->orderBy('name')->get();
    }
}
