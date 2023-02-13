<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index() {
        $data['periods'] = Period::orderBy('name', 'DESC')->get();
        return view('admin.pages.period.index', $data);
    }

    public function create() {
        $data['divisions'] = Division::all();
        return view('admin.pages.period.create', $data);
    }

    public function edit($id) {
        $period = Period::find($id);
        if ($period) {
            $data['period'] = $period;
            $data['divisions'] = Division::all();
            return view('admin.pages.period.edit', $data);
        }
        return redirect()->route('period')->with('error', 'Period tidak ditemukan');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:periods,name'
        ]);

        $period = Period::create([
            'name' => strtolower($request->name),
        ]);

        if (count(Period::all()) == 1) {
            $period->update(['status' => 1]);
        }

        return redirect()->route('period')->with('success', 'Period berhasil ditambahkan');
    }

    public function setActive($id) {
        $periods = Period::all();
        $periodActive = null;
        foreach ($periods as $period) {
            if ($period->id == $id) {
                $period->update([
                    'status' => 1,
                ]);
            }else {
                if ($period->status == 1) {
                    $period->update([
                        'status' => 0,
                    ]);
                }
            }
        }
        if ($periodActive) {
            return redirect()->route('period')->with('success', 'Berhasil beralih ke periode '.$period->name);
        }
        return redirect()->route('period')->with('error', 'Periode tidak ditemukan');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $period = Period::find($id);

        if ($period) {
            $period->update([
                'name' => strtolower($request->name),
            ]);
            return redirect()->route('period')->with('success', 'Period berhasil diubah');
        }
        return redirect()->route('period')->with('error', 'Period gagal diubah');

    }

    public function destroy($id) {
        $period = Period::find($id);

        if ($period) {
            if ($period->status == 1) {
                $period = Period::orderBy('id', 'DESC')->first();
                if ($period) $period->update(['status' => 1]);
            }
            $period->delete();
            return redirect()->route('period')->with('success', 'Period berhasil dihapus');
        }
        return redirect()->route('period')->with('error', 'Period gagal dihapus');
    }
}
