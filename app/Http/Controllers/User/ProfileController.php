<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile() {
        $user = Auth::user();
        return view('user.profile.index', compact(['user']));
    }

    public function notifications() {
        return view('user.notifications.index');
    }
}
