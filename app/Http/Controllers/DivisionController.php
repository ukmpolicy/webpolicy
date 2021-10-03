<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Program;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index() {
        $data['divisions'] = Division::all();
        return view('admin.pages.division.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $division = new Division();
        $division->name = strtolower($request->name);
        $division->save();
        
        return redirect()->route('division')->with('succes', 'Devisi berhasil ditambahkan');
    }

    public function edit($id) {
        $data['division'] = Division::find($id);
        $officers = Officer::where('division_id', $id)->get();
        $data['officers'] = array_map(function($v) {
            $v['member'] = Member::find($v['member_id']);
            $v['role'] = $this->getRole($v['role']);
            unset($v['member_id']);
            return $v;
        }, $officers->toArray());
        $data['programs'] = Program::where('division_id', $id)->get();
        return view('admin.pages.division.edit', $data);
    }

    public function getRole($role) {
        if ($role == 0) $role = 'ketua';
        if ($role == 1) $role = 'sekretaris';
        if ($role == 2) $role = 'bendahara';
        if ($role == 3) $role = 'anggota';
        return $role;
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $division = Division::find($id);
        if ($division) {
            $division->name = strtolower($request->name);
            $division->save();
            return redirect()->route('division')->with('succes', 'Devisi berhasil diubah');
        }
        return redirect()->route('division')->with('succes', 'Devisi gagal diubah');
    }

    public function destroy($id) {
        $division = Division::find($id);
        if ($division) {
            $division->delete();
            return redirect()->route('division')->with('succes', 'Devisi berhasil dihapus');
        }
        return redirect()->route('division')->with('succes', 'Devisi gagal dihapus');
    }

    public function storeProgram(Request $request, $division_id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'start_at' => 'required',
        ]);

        $program = new Program();
        $program->name = $request->name;
        $program->division_id = $division_id;
        $program->description = $request->description;
        $program->start_at = $request->start_at;
        $program->save();
        return redirect()->route('division.edit', ['id' => $division_id])->with('succes', 'Program berhasil ditambahkan');
    }
    
    public function updateProgram(Request $request, $division_id, $program_id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'start_at' => 'required',
        ]);

        $program = Program::find($program_id);
        $program->name = $request->name;
        $program->description = $request->description;
        $program->start_at = $request->start_at;
        $program->save();
        return redirect()->route('division.edit', ['id' => $division_id])->with('succes', 'Program berhasil diubah');
    }

    public function destroyProgram($division_id, $program_id) {
        $division = Division::find($division_id);
        $program = Division::find($program_id);
        if ($division && $program) {
            $program->delete();
            return redirect()->route('division.edit', ['id' => $division_id])->with('succes', 'Program berhasil dihapus');
        }
        return redirect()->route('division.edit', ['id' => $division_id])->with('succes', 'Program gagal dihapus');
    }
}
