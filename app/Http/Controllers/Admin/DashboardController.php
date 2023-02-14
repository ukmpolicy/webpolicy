<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        
        $role_id = auth()->user()->role_id;

        foreach (getSidebarMenu() as $menu) {
            $permission = Permission::where('name', $menu['permission'])->first();
            $permission_id = ($permission) ? $permission->id : null;
            if (!is_null(RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first())) {
                if ($menu['route'] == 'dashboard') {
                    break;
                }
                return redirect()->route($menu['route']);
            }
        }

        $data["moons"] = explode(", ", "januari, februari, mare, april, mei, juni, juli, agustus, september, oktober, november, desember");
        $data['mbd'] = $this->getMBD();
        return view('admin.pages.dashboard.index', $data);
    }
    
    public function getMBD() {
        $mbd = Member::where('born_at', '!=', null)->select('id', 'name', 'born_at')->get()->toArray();
        $rows = [];
        for ($i=0; $i<12; $i++) {
            $rows[$i] = [];
            for ($i2=0; $i2<32; $i2++) {
                $rows[$i][$i2] = [];
            }
        }

        
        foreach ($mbd as $v) {
            $time = strtotime($v['born_at']);
            $rows[(int) date('m', $time) - 1][(int)date('d', $time) - 1][] = $v;
            // echo $v['name'] . ' - ' . date('d/m', strtotime($v["born_at"])) . '<br>';
        }
        // die;
        return $rows;
    }
}
