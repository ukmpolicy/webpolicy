<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Period;
use App\Models\Program;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request) {
        $data['periods'] = Period::all();
        $data['period_active'] = Period::getPeriodeActive();
        $divisions = Division::leftJoin('periods', 'periods.id', '=', 'divisions.period_id')->selectRaw('divisions.*, periods.name as period');
        if ($request->period) {
            $divisions = $divisions->where('period_id', $request->period);
        }else {
            $divisions = $divisions->where('period_id', Period::getPeriodeActive()->id);
        }
        $data['divisions'] = $divisions->get();
        return view('admin.pages.division.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'period_id' => 'required',
        ]);
        $division = new Division();
        $division->name = strtolower($request->name);
        $division->period_id = $request->period_id;
        $division->save();
        
        return redirect()->route('division')->with('success', 'Devisi berhasil ditambahkan');
    }

    public function edit($id) {
        $officers = Officer::select('officers.id', 'members.name', 'positions.name as position', 'positions.division_id')
        ->join('members','officers.member_id','=','members.id')
        ->join('positions','officers.position_id','=','positions.id')
        ->where('positions.division_id', $id);
        // dd($officers->get()->toArray());

        $data['division'] = Division::find($id);
        $data['periods'] = Period::all();
        $data['officers'] = $officers->get();
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
            'period_id' => 'required',
        ]);
        $division = Division::find($id);
        if ($division) {
            $division->name = strtolower($request->name);
            $division->period_id = $request->period_id;
            $division->save();
            return redirect()->route('division.edit', ['id' => $division->id])->with('success', 'Devisi berhasil diubah');
        }
        return redirect()->route('division')->with('failed', 'Devisi gagal diubah');
    }

    public function destroy($id) {
        $division = Division::find($id);
        if ($division) {
            $division->delete();
            return redirect()->route('division')->with('success', 'Devisi berhasil dihapus');
        }
        return redirect()->route('division')->with('failed', 'Devisi gagal dihapus');
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
        return redirect()->route('division.edit', ['id' => $division_id])->with('success', 'Program berhasil ditambahkan');
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
        return redirect()->route('division.edit', ['id' => $division_id])->with('success', 'Program berhasil diubah');
    }

    public function destroyProgram($division_id, $program_id) {
        $division = Division::find($division_id);
        $program = Program::find($program_id);
        if ($division && $program) {
            $program->delete();
            return redirect()->route('division.edit', ['id' => $division_id])->with('success', 'Program berhasil dihapus');
        }
        return redirect()->route('division.edit', ['id' => $division_id])->with('success', 'Program gagal dihapus');
    }
}
