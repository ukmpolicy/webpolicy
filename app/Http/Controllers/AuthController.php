<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.pages.auth.login');
    }

    public function login(Request $request) {
        if (User::all()->isEmpty()) {
            $this->createUser('pemrograman', 'admin', 3);
        }
        $this->validate($request, [
            "username" => 'required',
            "password" => 'required',
        ]);

        if (!Auth::attempt($request->only(['username', 'password']))) {
            return redirect()->route('login')->with('error', 'Username atau password anda salah');
        }
        
        return redirect()->route('dashboard')->with('success', 'Anda telah berhasil melakukan login');
    }

    public function createUser(String $username, String $password = 'admin', $level = 0) {
        $user = new User();
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->level = $level;
        $user->save();
        return $user;
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil melakukan logout');
    }

    public function me() {
        $user = User::find(Auth::user()->id);
        return response()->json($user->toArray());
    }
}
