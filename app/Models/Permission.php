<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    private static $permissions =  [
        "admin",
        "admin.article",
        "admin.documentation",
        "admin.mailbox",
        "admin.member",
        "admin.role",
        "admin.role.permission",
        "admin.event.or",
        "admin.setting",
        "admin.officer",
        "admin.division",
        "admin.dashboard",
        "admin.struktural",
    ];

    public static function isExists(string $name) {
        return !is_null(self::where('name', $name)->first());
    }

    public static function getByName(string $name) {
        return self::where('name', $name)->first();
    }

    public static function initPerms() {
        foreach (self::$permissions as $name) {
            if (!self::isExists($name)) {
                self::create(["name" => $name]);
            }
        }
    }
}
