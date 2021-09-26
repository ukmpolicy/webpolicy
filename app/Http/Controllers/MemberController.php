<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{

    private $majors = [
        "Teknik Elektro" => [
            "Teknik Listrik",
            "Teknik Telekomunikasi",
            "Teknik Elektronika",
            "Instrumentasi dan Otomasi Industri",
            "Teknik Jaringan Telekomunikasi",
            "Teknik Pembangkit Energi Listrik",
        ],
        "Teknik Informasi dan Komputer" => [
            "Teknologi Informasi",
            "Teknik Rekayasa Komputer Jaringan",
            "Teknik Rekayasa Multi Media"
        ],
        "Teknik Sipil" => [
            "Teknik Sipil D3",
            "Teknik Sipil D4"
        ],
        "Teknik Kimia" => [
            "Teknologi Kimia Industri",
            "Teknik Kimia D3",
            "Pengolahan Minyak dan Gas Bumi"
        ],
        "Teknik Mesin" => [
            "Teknik Mesin D3",
            "Teknik Mesin D4",
        ],
        "Tata Niaga" => [
            "Akuntansi",
            "Keuangan dan Perbankan",
            "Keuangan dan Perbankan Syariah",
            "Administrasi Bisnis"
        ],
    ];

    private $status = [
        "Anggota",
        "Pengurus",
        "Alumni",
    ];

    public function index() {
        $data['members'] = Member::all(); 

        $data['status'] = $this->status;
        return view('admin.pages.member.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "nim" => "required|unique:members,nim",
            "name" => "required",
        ]);
        $member = new Member();
        $member->name = strtolower($request->name);
        $member->nim = $request->nim;
        $member->save();

        return redirect()->route('member')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id) {
        $member = Member::find($id);
        if ($member) {
            $data['member'] = $member;
            $majors = json_encode($this->majors);
            $data['majors'] = $majors;
            $data['image'] = ($member->profile_picture) ? Source::find($member->profile_picture) : '';
            
            return view('admin.pages.member.edit', $data);
        }
        return redirect()->route('member');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            "nim" => "required|unique:members,nim,".$id,
            "name" => "required",
            "address" => "required",
            "phone_number" => "required",
            "email" => "required|email",
            "major" => "required",
            "study_program" => "required",
            "interested_in" => "required",
            "profile_picture" => "required|exists:sources,id",
            "born_at" => "required",
            "birth_place" => "required",
            "joined_at" => "required",
        ]);

        $member = Member::find($id);
        if ($member) {
            $member->nim = $request->nim;
            $member->profile_picture = $request->profile_picture;
            $member->name = strtolower($request->name);
            $member->address = strtolower($request->address);
            $member->phone_number = $request->phone_number;
            $member->email = strtolower($request->email);
            $member->major = strtolower($request->major);
            $member->study_program = strtolower($request->study_program);
            $member->interested_in = strtolower($request->interested_in);
            $member->born_at = strtolower($request->born_at);
            $member->birth_place = $request->birth_place;
            $member->joined_at = $request->joined_at;
            $member->save();
            return redirect()->route('member.edit', ['id' => $member->id])->with('success', 'Perubahan berhasil disimpan!');
        }

        return redirect()->route('member')->with('failed', 'Anggota tidak ditemukan!');
    }

    public function destroy($id) {
        $member = Member::find($id);
        if ($member) {
            $temp = $member;
            $member->delete();
            return redirect()->route('member')->with('success', 'Anggota dengan nama '.$temp->name.' berhasil dihapus');
        }
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

    public function newMember(Request $request) {
        
        $this->validate($request, [
            "nim" => "required|unique:members,nim",
            "name" => "required",
            "address" => "required",
            "phone_number" => "required",
            "email" => "required|email",
            "major" => "required",
            "study_program" => "required",
            "interested_in" => "required",
            "profile_picture" => "required|exists:sources,id",
            "born_at" => "required",
            "birth_place" => "required"
        ]);

        $member = new Member();
        $member->nim = $request->nim;
        $member->profile_picture = $request->profile_picture;
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

        return redirect()->route('main.recruitment.success')->with('success', 'Anda berhasil mengdaftar');
    }
}
