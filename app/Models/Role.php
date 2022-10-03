<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function hasPermission(string $name) {
        return !is_null(RolePermission::where('role_id', $this->id)->where('permission_id', Permission::getByName($name)->id)->first());
    }

    public static function isExists(string $name) {
        return !is_null(self::where('name', $name)->first());
    }

    public static function initRole() {
        Permission::initPerms();
        $roles = [
            "guest" => [],
            "admin" => [
                "admin",
                "admin.role",
                "admin.role.dashboard",
                "admin.role.permission",
            ], 
        ];

        foreach ($roles as $role => $permissions) {
            if (!self::isExists($role)) {
                $role = Role::create(["name" => $role]);
                foreach ($permissions as $permission) {
                    $role->addPermission($permission);
                }
            }else {
                $role = Role::where('name', $role)->first();
                foreach ($permissions as $permission) {
                    if (!$role->hasPermission($permission)) {
                        $role->addPermission($permission);
                    }
                }
            }
        }
    }

    public function addPermission(string $name) {
        if (!$this->hasPermission($name)) {
            if (Permission::isExists($name)) {
                RolePermission::create([
                    "role_id" => $this->id,
                    "permission_id" => Permission::getByName($name)->id,
                ]);
                return true;
            }
        }
        return false;
    }

    public function removePermission(string $name) {
        if ($this->hasPermission($name)) {
            $rp = RolePermission::where('role_id', $this->role_id)->where("permission_id", Permission::getByName($name)->id)->first();
            if ($rp) {
                $rp->delete();
                return true;
            }
        }
        return false;
    }

}
