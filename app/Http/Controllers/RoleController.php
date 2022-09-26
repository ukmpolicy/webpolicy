<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index() {
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('admin.pages.role.index', $data);
    }

    public function destroy($id) {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return redirect()->route('role')->with('success', 'Role berhasil dihapus');
        }
        return redirect()->route('role')->with('success', 'Role gagal dihapus');
    }

    public function store(Request $request) {
        $this->validate($request, [
            "name" => "required",
        ]);

        $role = Role::create(["name" => strtolower($request->name)]);
        if ($request->permissions) {
            foreach ($request->permissions as $permission_id) {
                RolePermission::create([
                    "role_id" => $role->id,
                    "permission_id" => $permission_id,
                ]);
            }
        }

        return redirect()->route('role')->with('success', 'Role berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            "name" => "required",
        ]);

        $role = Role::find($id);
        if ($role) {
            $rp = RolePermission::where('role_id', $role->id)->get();
            foreach ($rp as $r) $r->delete();
            if ($request->permissions) {
                foreach ($request->permissions as $permission_id) {
                    RolePermission::create([
                        "role_id" => $role->id,
                        "permission_id" => $permission_id,
                    ]);
                }
            }
            return redirect()->route('role')->with('success', 'Role berhasil diubah');
        }
        return redirect()->route('role')->with('error', 'Role tidak ditemukan');
    }

    public function addAccess(Request $request, $id) {
        $this->validate($request, [
            "email" => "required|exists:users,email",
        ]);

        $role = Role::find($id);
        if ($role) {
            $user = User::where('email', $request->email)->first();
            $user->role_id = $role->id;
            $user->save();
        
            return redirect()->route('role')->with('success', 'Akses berhasil ditambahkan');
        }
        return redirect()->route('role')->with('error', 'Role tidak ditemukan');
    }

}
