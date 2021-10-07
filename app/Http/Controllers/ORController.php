<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ORDocument;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
// use Barryvdh\DomPDF\Facade\PDF;

class ORController extends Controller
{
    public function index() {
        return view('user.open_recruitment.index');
    }

    public function viewForm() {
        return view('user.open_recruitment.form');
    }

    public function store(Request $request) {
        // dd($request->all());
        // dd($request->born_at);
        $vals = [
            'photo' => 'required|exists:sources,id',
            'proof_pkkmb' => 'required|exists:sources,id',
            "nim" => "required|unique:members,nim",
            "name" => "required",
            "address" => "required",
            "phone_number" => "required",
            "email" => "required|email",
            "major" => "required",
            "study_program" => "required",
            "interested_in" => "required",
            "born_at" => "required",
            "birth_place" => "required"
        ];
        if ($request->certificate) {
            $vals['certificate'] = 'exists:sources,id';
        }
        $this->validate($request, $vals);
        
        $member = new Member();
        $member->nim = $request->nim;
        $member->profile_picture = $request->photo;
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

        $or_doc = new ORDocument();
        $or_doc->member_id = $member->id;
        if ($request->certificate) $or_doc->certificate = $request->certificate;
        $or_doc->proof_pkkmb = $request->proof_pkkmb;
        $or_doc->save();

        // return response()->download($pathToFile, $name, $headers);
        return redirect()->route('open-recruitment.proof', ['nim' => $member->nim]);
    }

    public function proof($nim) {
        $member = Member::where('nim', $nim)->first();
        if ($member) {
            $doc = ORDocument::where('member_id', $member->id)->first();
            if ($doc) {
                $data = array_merge($member->toArray(), $doc->toArray());
                $data['profile_picture'] = Source::find($data['profile_picture'])->path;
                // $data['certificate'] = Source::find($data['certificate'])->path;
                // $data['proof_pkkmb'] = Source::find($data['proof_pkkmb'])->path;

                return view('user.open_recruitment.proof', $data);
            }
        }
        return redirect()->route('main.home');
    }

    public function successPage() {
        if (session('success')) {
        }
        return redirect()->route('main.home');
    }

    public function check($nim) {
        $member = Member::where('nim', $nim)->first();
        if ($member) {
            $doc = ORDocument::where('member_id', $member->id)->first();
            if ($doc) {
                $data = array_merge($member->toArray(), $doc->toArray());
                // dd($data);
                $data['profile_picture'] = Source::find($data['profile_picture'])->path;
                $data['certificate'] = Source::find($data['certificate'])->path;
                $data['proof_pkkmb'] = Source::find($data['proof_pkkmb'])->path;

                return view('user.open_recruitment.check', $data);
            }
        }
        return redirect()->route('main.home');
    }
}
