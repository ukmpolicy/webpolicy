<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Period;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request) {
        $period = ($request->period) ? $request->period : Period::getPeriodeActive()->id;
        $positions = Position::leftJoin('periods', 'periods.id', '=', 'positions.period_id')
        ->selectRaw('positions.*, periods.name as period')->where('sub_in_position_id', null)
        ->where('period_id', $period)->orderBy('index')->get();

        foreach ($positions as $position) {
            $position->members = Position::leftJoin('periods', 'periods.id', '=', 'positions.period_id')->selectRaw('positions.*, periods.name as period')->where('sub_in_position_id', $position->id)->orderBy('index')->get();
        }
        $data['period_active'] = Period::getPeriodeActive();
        $data['periods'] = Period::all();
        $data['divisions'] = Division::where('period_id', $period)->get();
        $data['positions'] = $positions;
        return view('admin.pages.position.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'period_id' => 'required',
        ]);

        $position = null;
        $index = 1;
        $in_division = $request->in_division;

        if ($request->division_id) {
            if ($request->in_division) {
                $position = Position::where('division_id', $request->division_id)->where('sub_in_position_id', null)->first();
            }
        }
        if ($in_division) {
            $index = Position::getLastIndexInDivision($request->division_id);
        }else {
            $index = Position::getLastIndex();
        }

        Position::create([
            'name' => strtolower($request->name),
            'period_id' => $request->period_id,
            'division_id' => $request->has('division_id') ? $request->division_id : null,
            'sub_in_position_id' => $position ? $position->id : null,
            'index' => $index,
        ]);

        return redirect()->route('position')->with('success', 'Position berhasil ditambahkan');
    }

    public function moveDownIndex(Request $request, $id) {
        $position = Position::find($id);
        if ($position) {
            $index = $position->index;
            $bottomPosition = Position::where('index', $index+1)->where('sub_in_position_id', $request->subof)->first();
            if ($bottomPosition) {
                $bottomPosition->update([
                    'index' => $index,
                ]);
                $position->update([
                    'index' => $index+1,
                ]);
                return redirect()->route('position')->with('success', 'Position berhasil diubah');
            }
        }
        return redirect()->route('position')->with('failed', 'Position gagal diubah');
    }

    public function moveUpIndex(Request $request, $id) {
        $position = Position::find($id);
        if ($position) {
            $index = $position->index;
            $topPosition = Position::where('index', $index-1)->where('sub_in_position_id', $request->subof)->first();
            if ($topPosition) {
                $topPosition->update([
                    'index' => $index,
                ]);
                $position->update([
                    'index' => $index-1,
                ]);
                return redirect()->route('position')->with('success', 'Position berhasil diubah');
            }
        }
        return redirect()->route('position')->with('failed', 'Position gagal diubah');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'period_id' => 'required',
        ]);

        $position = Position::find($id);

        if ($position) {
            $position->update([
                'name' => strtolower($request->name),
                'period_id' => $request->period_id,
                'division_id' => $request->has('division_id') ? $request->division_id : null,
                'sub_in_position_id' => $request->has('sub_in_position_id') ? $request->sub_in_position_id : null,
            ]);
            return redirect()->route('position')->with('success', 'Position berhasil diubah');
        }
        return redirect()->route('position')->with('error', 'Position gagal diubah');
    }

    public function destroy($id) {
        $position = Position::find($id);

        if ($position) {
            $positions = Position::where('sub_in_position_id', $position->id)->get();
            foreach ($positions as $pos) $pos->delete();
            $position->delete();
            return redirect()->route('position')->with('success', 'Position berhasil dihapus');
        }
        return redirect()->route('position')->with('error', 'Position gagal dihapus');
    }
}
