<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Member;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{

    public static $roles = [
        "ketua", "sekretaris", "bendahara", "anggota"
    ];

    public function index(Request $request) {
        $officers = $this->getOfficers($request);

        $data['officers'] = $officers;
        $data['roles'] = self::$roles;
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($officers->count()/$perPage);

        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;
        return view('admin.pages.office.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "nim" => "required|exists:members,nim",
            "role" => "required",
            "division_id" => "required|exists:divisions,id",
            "period_start_at" => "required",
            "period_end_at" => "required",
        ]);
        $member = Member::where('nim', $request->nim)->first();
        if ($member) {
            $office = new Officer();
            $office->member_id = $member->id;
            $office->division_id = $request->division_id;
            $office->role = $request->role;
            $office->period_start_at = $request->period_start_at;
            $office->period_end_at = $request->period_end_at;
            $office->save();

            return redirect()->route('office')->with('succes', 'Pengurus berhasil ditambahkan');
        }
        return redirect()->route('office')->with('error', 'Pengurus gagal ditambahkan');
    }

    public function create() {
        $data['divisions'] = Division::all();
        return view('admin.pages.office.create', $data);
    }
    
    public function edit($id) {
        $officer = Officer::where('members.id', $id)
        ->select('officers.id', 'members.nim', 'members.name', 'division_id', 'role', 'period_start_at', 'period_end_at')
        ->join('members', 'officers.member_id', '=', 'members.id')
        ->first();
        $data['divisions'] = Division::all();
        $data['roles'] = self::$roles;
        $data['officer'] = $officer;
        unset($officer['member_id']);
        return view('admin.pages.office.edit', $data);
    }


    public function getOfficers(Request $request) {
        $officers = Officer::select(
            'officers.id', 'members.name', 'divisions.name as division', 'role', 'period_start_at', 'period_end_at')
        ->join('members','officers.member_id','=','members.id')
        ->join('divisions','officers.division_id','=','divisions.id');

        
        if ($request->search) {
            $officers = $officers->where('members.name', 'like', '%'. $request->search . '%')
            ->orWhere('nim', 'like', '%'. $request->search . '%');
        }
        return $officers->get();
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            "nim" => "required|exists:members,nim",
            "role" => "required",
            "division_id" => "required|exists:divisions,id",
            "period_start_at" => "required",
            "period_end_at" => "required",
        ]);
        $office = Officer::find($id);
        if ($office) {
            $member = Member::where('nim', $request->nim)->first();
            $office->member_id = $member->id;
            $office->division_id = $request->division_id;
            $office->role = $request->role;
            $office->period_start_at = $request->period_start_at;
            $office->period_end_at = $request->period_end_at;
            $office->save();

            return redirect()->route('office')->with('succes', 'Pengurus berhasil diubah');
        }
        return redirect()->route('office')->with('error', 'Pengurus gagal diubah');
    }

    public function destroy($id) {
        $office = Officer::find($id);
        if ($office) {
            $office->delete();
            
            return redirect()->route('office')->with('succes', 'Pengurus berhasil dihapus');
        }
        return redirect()->route('office')->with('error', 'Pengurus gagal dihapus');
    }

}
