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
        "admin.dashboard",

        // Media
        "admin.article",
        "admin.documentation",
        "admin.mailbox",

        // Kepengurusan
        "admin.member",
        "admin.division",
        "admin.officer",
        "admin.struktural",
        "admin.period",
        "admin.position",

        // Settings
        "admin.setting",
        "admin.role",
        "admin.role.permission",

        // Open Recruitment
        "admin.event.or",
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
                dd(self::$permissions);
                self::create(["name" => $name]);
            }
        }
    }
}
