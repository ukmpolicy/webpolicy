<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Period;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{

    public function index(Request $request) {
        $officers = $this->getOfficers($request);

        $data['periods'] = Period::all();
        $data['period_active'] = Period::getPeriodeActive();
        if ($request->period) {
            $data['positions'] = Position::where('period_id', $request->period)->get();
        }else {
            $data['positions'] = Position::where('period_id', (Period::getPeriodeActive()) ? Period::getPeriodeActive()->id : null)->get();
        }
        $data['officers'] = $officers;
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($officers->count()/$perPage);
        
        if (is_numeric($request->page)) {
            $page = $request->page;
        }

        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;
        return view('admin.pages.office.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "nim" => "required|exists:members,nim",
            "position_id" => "required|exists:positions,id",
        ]);
        $member = Member::where('nim', $request->nim)->first();
        if ($member) {
            $filename = $member->profile_picture;
            if ($request->file('picture')) {
                $file = $request->file('picture');
                $filename = time().rand(1111,9999).'.'.$file->getClientOriginalExtension();
                $dir = 'uploads/';
                $file->move($dir, $filename);
            }
            $office = new Officer();
            $office->member_id = $member->id;
            $office->position_id = $request->position_id;
            $office->picture = $filename;
            $office->save();

            return redirect()->route('office')->with('succes', 'Pengurus berhasil ditambahkan');
        }
        return redirect()->route('office')->with('error', 'Pengurus gagal ditambahkan');
    }

    public function getOfficers(Request $request) {

        $officers = Officer::select('officers.id', 'members.name', 'members.nim', 'officers.picture', 'positions.name as position', 'periods.name  as period', 'positions.period_id')
        ->join('members','officers.member_id','=','members.id')
        ->join('positions','officers.position_id','=','positions.id')
        ->join('periods','positions.period_id','=','periods.id');
        
        if ($request->search) {
            $officers = $officers->where('members.name', 'like', '%'. $request->search . '%')
            ->orWhere('nim', 'like', '%'. $request->search . '%')
            ->orWhere('positions.name', 'like', '%'. $request->search . '%');
        }
        if ($request->period) {
            $officers = $officers->where('positions.period_id', $request->period);
        }else {
            $officers = $officers->where('positions.period_id', (Period::getPeriodeActive()) ? Period::getPeriodeActive()->id : null);
        }
        return $officers->get();
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            "nim" => "required|exists:members,nim",
            "position_id" => "required|exists:positions,id",
        ]);
        $officer = Officer::find($id);
        if ($officer) {
            $member = Member::where('nim', $request->nim)->first();
            if ($member) {
                $filename = $officer->picture;
                if ($request->file('picture')) {
                    $file = $request->file('picture');
                    $filename = time().rand(1111,9999).'.'.$file->getClientOriginalExtension();
                    $dir = 'uploads/';
                    $file->move($dir, $filename);
                }
                $officer->member_id = $member->id;
                $officer->position_id = $request->position_id;
                $officer->picture = $filename;
                $officer->save();
    
                return redirect()->route('office')->with('succes', 'Pengurus berhasil diubah');
            }
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
