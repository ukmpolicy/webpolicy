<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\MembersImport;
use App\Models\Member;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{

    public static $status = [
        "Anggota",
        "Alumni",
    ];

    private $majors = [
        "Teknik Sipil" => [
            "Teknologi Kontruksi Bangunan Air",
            "Teknologi Rekayasa Kontruksi Bangunan Gedung",
            "Teknologi Kontruksi Jalan dan Jembatan",
            "Teknologi Rekayasa Kontruksi Jalan dan Jembatan",
            "Jalur Cepat Pengukuran dan Penggambaran Tapak Bangunan Gedung",
        ],
        "Teknik Mesin" => [
            "Teknologi Rekayasa Manufaktur",
            "Teknologi Mesin",
            "Teknologi Industri",
            "Teknologi Rekayasa Pengelasan dan Fabrikasi",
        ],
        "Teknik Kimia" => [
            "Teknologi Kimia",
            "Teknologi Pengolahan Minyak dan Gas Bumi",
            "Teknologi Rekayasa Kimia Industri",
        ],
        "Teknik Elektro" => [
            "Teknologi Listrik",
            "Teknologi Rekayasa Pembangkit Energi",
            "Teknologi Rekayasa Jaringan Telekomunikasi",
            "Teknologi Rekayasa Instrumentasi dan Kontrol",
            "Teknologi Telekomunikasi",
            "Teknologi Elektronika",
            "Teknologi Metronika",
        ],
        "Tata Niaga" => [
            "Akuntansi",
            "Administrasi Bisnis",
            "Akuntansi Sektor Publik",
            "Akuntasi Lembaga Keuangan Syariah",
            "Manajemen Keuangan Sektor Publik",
        ],
        "Teknologi Informasi dan Komputer" => [
            "Teknik Informatika",
            "Teknologi Rekayasa Komputer Jaringan",
            "Teknologi Rekayasa Multimedia",
        ],
    ];  

    public function index(Request $request) {
        // dd(strtotime('2001-12-10'), strtotime('12/10/2001'));
        // $this->repairDate();
        $members = $this->getMembers($request);
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($members->count()/$perPage);

        if (is_numeric($request->page)) {
            $page = $request->page;
        }
        if (is_numeric($request->count) || strtolower($request->count) == 'all') {
            $perPage = $request->count;
        }

        $data['members'] = $members;
        $data['status'] = self::$status;
        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;
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

        return redirect()->route('member.edit',['id' => $member->id])->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id) {
        $member = Member::find($id);
        if ($member) {
            $data['member'] = $member;
            $majors = json_encode($this->majors);
            $data['majors'] = $majors;
            $data['status'] = self::$status;
            $data['image'] = ($member->profile_picture) ? Source::find($member->profile_picture) : '';
            
            return view('admin.pages.member.edit', $data);
        }
        return redirect()->route('member')->with('failed', 'Anggota tidak ditemukan!');
    }

    public function update(Request $request, $id) {
        // $this->validate($request, [
        //     "nim" => "required|unique:members,nim,".$id,
        //     "name" => "required",
        //     "address" => "required",
        //     "phone_number" => "required",
        //     "email" => "required|email",
        //     "major" => "required",
        //     "study_program" => "required",
        //     "graduation_at" => "required",
        //     "photo" => "",
        //     "born_at" => "required",
        //     "birth_place" => "required",
        //     "joined_at" => "required",
        //     "other_detail" => "required",
        // ]);
        
        $member = Member::find($id);

        
        if ($member) {
            $filename = $member->photo;

            if ($file = $request->file('photo')) {
                $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
                $dir = 'uploads/';
                $file->move($dir, $filename);
                $member->profile_picture = $filename;
            }
            if ($request->nim)           $member->nim = $request->nim;
            if ($request->name)          $member->name = strtolower($request->name);
            if ($request->address)       $member->address = strtolower($request->address);
            if ($request->phone_number)  $member->phone_number = $request->phone_number;
            if ($request->email)         $member->email = strtolower($request->email);
            if ($request->major)         $member->major = strtolower($request->major);
            if ($request->study_program) $member->study_program = strtolower($request->study_program);
            if ($request->graduation_at) $member->graduation_at = strtolower($request->graduation_at);
            if ($request->born_at)       $member->born_at = strtotime($request->born_at);
            if ($request->birth_place)   $member->birth_place = $request->birth_place;
            if ($request->joined_at)     $member->joined_at = $request->joined_at;
            if ($request->other_detail)     $member->other_detail = $request->other_detail;
            // if ($request->other_detail)  $member->other_detail = $request->other_detail;
            $member->save();
            return redirect()->route('member.edit', ['id' => $member->id])->with('success', 'Perubahan berhasil disimpan!');
        }

        return redirect()->route('member')->with('failed', 'Anggota tidak ditemukan!');
    }

    public function migrate() {
        foreach (Member::all() as $m) {
            $f = Source::find($m->profile_picture);
            if ($f) {
                $filename = $f->path;
                $member = Member::find($m->id);
                $member->photo = $filename;
                $member->save();
            }
        }
    }

    public function import(Request $request) {
        $this->validate($request, [
            'file_import' => 'required'
        ]);
        Excel::import(new MembersImport, $request->file('file_import'));
        return redirect()->route('member')->with('success', 'Data berhasil diimport!');
    }

    public function destroy($id) {
        $member = Member::find($id);
        if ($member) {
            $temp = $member;
            $member->delete();
            return redirect()->back()->with('success', 'Anggota dengan nama '.$temp->name.' berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Anggota tidak ditemukan');
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



    public function getMembers(Request $request) {

        $data['members'] = [];
        $members = Member::whereIn('status', [0,1,2]);

        if ($request->status) {
            $status = '';
            foreach (self::$status as $k => $v) if ($request->status == strtolower($v)) $status = $k;
            $members = Member::where('status', $status);
        }

        if ($request->search) {
            $members = $members->where('name', 'like', '%'. $request->search . '%')
            ->orWhere('nim', 'like', '%'. $request->search . '%');
        }

        return $members->orderBy('name')->get();
    }
}
