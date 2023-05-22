<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile($username) {
        $user = User::where('username', $username)->first();
        return view('user.profile.index', compact(['user']));
    }

    public function openRecruitment() {
        return view('user.or.index');
    }
}
