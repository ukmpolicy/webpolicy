<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index() {
        $officers = Officer::all();
        $data['divisions'] = Division::all();
        $data['officers'] = array_map(function($v) {
            $division = Division::find($v['division_id']);
            $member = Member::find($v['member_id']);
            $v['member'] = ($member) ? $member->name : '';
            $v['division'] = ($division) ? $division->name : '';
            $v['role'] = $this->getRole($v['role']);
            unset($v['member_id']);
            unset($v['division_id']);
            return $v;
        }, $officers->toArray());
        // dd($data['officers']);
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
        $officer = Officer::find($id)->toArray();
        $data['divisions'] = Division::all();
        $officer['member'] = Member::find($officer['member_id']);
        $data['officer'] = $officer;
        unset($officer['member_id']);
        return view('admin.pages.office.edit', $data);
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

    public function getRole($role) {
        if ($role == 0) $role = 'ketua';
        if ($role == 1) $role = 'sekretaris';
        if ($role == 2) $role = 'bendahara';
        if ($role == 3) $role = 'anggota';
        return $role;
    }
}
