<?php

namespace App\Http\Controllers;

use App\Models\Devision;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Program;
use Illuminate\Http\Request;

class DevisionController extends Controller
{
    public function index() {
        $data['devisions'] = Devision::all();
        return view('admin.pages.devision.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $devision = new Devision();
        $devision->name = strtolower($request->name);
        $devision->save();
        
        return redirect()->route('devision')->with('succes', 'Devisi berhasil ditambahkan');
    }

    public function edit($id) {
        $data['devision'] = Devision::find($id);
        $officers = Officer::where('devision_id', $id)->get();
        $data['officers'] = array_map(function($v) {
            $v['member'] = Member::find($v['member_id']);
            $v['role'] = $this->getRole($v['role']);
            unset($v['member_id']);
            return $v;
        }, $officers->toArray());
        $data['programs'] = Program::where('devision_id', $id)->get();
        return view('admin.pages.devision.edit', $data);
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
        $devision = Devision::find($id);
        if ($devision) {
            $devision->name = strtolower($request->name);
            $devision->save();
            return redirect()->route('devision')->with('succes', 'Devisi berhasil diubah');
        }
        return redirect()->route('devision')->with('succes', 'Devisi gagal diubah');
    }

    public function destroy($id) {
        $devision = Devision::find($id);
        if ($devision) {
            $devision->delete();
            return redirect()->route('devision')->with('succes', 'Devisi berhasil dihapus');
        }
        return redirect()->route('devision')->with('succes', 'Devisi gagal dihapus');
    }

    public function storeProgram(Request $request, $devision_id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'start_at' => 'required',
        ]);

        $program = new Program();
        $program->name = $request->name;
        $program->devision_id = $devision_id;
        $program->description = $request->description;
        $program->start_at = $request->start_at;
        $program->save();
        return redirect()->route('devision.edit', ['id' => $devision_id])->with('succes', 'Program berhasil ditambahkan');
    }
    
    public function updateProgram(Request $request, $devision_id, $program_id) {
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
        return redirect()->route('devision.edit', ['id' => $devision_id])->with('succes', 'Program berhasil diubah');
    }

    public function destroyProgram($devision_id, $program_id) {
        $devision = Devision::find($devision_id);
        $program = Devision::find($program_id);
        if ($devision && $program) {
            $program->delete();
            return redirect()->route('devision.edit', ['id' => $devision_id])->with('succes', 'Program berhasil dihapus');
        }
        return redirect()->route('devision.edit', ['id' => $devision_id])->with('succes', 'Program gagal dihapus');
    }
}
