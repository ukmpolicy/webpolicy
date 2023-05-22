<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index() {
        // $user = User::find(Auth::user()->id);
        foreach (User::all() as $user) {
            $user->username = $this->generateRandomUsername();
            $user->save();
        }
        return 'ok';
        // return view('user.setting.index', compact('user'));
    }

    public function generateRandomUsername() {
        $time = substr(time(), -4);
        $username = generateRandomString(6).'-'.$time.rand(1000,9999);
        while (!is_null(User::where('username', $username)->first())) {
            $username = generateRandomString(5).'-'.$time.rand(1000,9999);
        }
        return $username;
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'picture' => ['nullable', 'image', 
                function ($attribute, $value, $fail) {
                    $imageInfo = getimagesize($value);
                    $width = $imageInfo[0];
                    $height = $imageInfo[1];
                    
                    if ($width !== $height) {
                        $fail('The '.$attribute.' must have a 1:1 aspect ratio.');
                    }
                }
            ],
            'name' => 'required',
            'username' => [
                'required', 'alpha_dash',
                Rule::unique('users')->ignore($id),
            ],
            'bio' => 'required',
        ]);

        
        $user = User::find($id);
        if ($user) {
            $file = $request->file('picture');
            $filename = $user->picture;
            if ($file) {
                if ($filename) {
                    if (file_exists('/uploads/'.$filename)) {
                        unlink('/uploads/'.$filename);
                    }
                }
                $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
            }
            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->bio = $request->get('bio');
            $user->picture = $filename;
            $user->save();
            return redirect()->back()->with('success', 'Changes saved successfully');
        }
        return redirect()->route('home');
    }
}
