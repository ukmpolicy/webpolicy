<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ORController extends Controller
{
    public function index() {
        return view('user.open_recruitment.index');
    }

    public function viewForm() {
        return view('user.open_recruitment.form');
    }

    public function store(Request $request) {

    }

    public function successPage(Request $request) {
        return view('user.open_recruitment.done');
    }
}
