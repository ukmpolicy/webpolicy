<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $data['users'] = User::all();
        return view('admin.pages.user.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'cpassword' => 'same:password',
            'level' => 'required'
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
    }
    
    public function update(Request $request, $id) {
        $this->validate($request, [
            'username' => 'required',
            'cpassword' => 'same:password',
            'level' => 'required'
        ]);
        $user = User::find($id);
        if ($user) {
            $user->username = $request->username;
            // dd(strlen($request->password));
            if (strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->level = $request->level;
            $user->save();
            return redirect()->route('user')->with('success', 'User berhasil diubah');
        }
        return redirect()->route('user')->with('success', 'User gagal diubah');
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user')->with('success', 'User berhasil dihapus');
        }
        return redirect()->route('user')->with('success', 'User gagal dihapus');
    }
}
