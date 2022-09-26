<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;

function hasPermission($role_id, $permission_id) {
    return !is_null(RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first());
}

function hasPermissionByName($permission) {
    $role_id = auth()->user()->role_id;
    $permission = Permission::where('name', $permission)->first();
    $permission_id = ($permission) ? $permission->id : null;
    return !is_null(RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first());
}

function getSidebarMenu() {
    return [
        sidebarMenu("Dashboard", "tachometer-alt", "dashboard", "admin.dashboard"),
        sidebarMenu("Role", "user-cog", "role", "admin.role"),
        sidebarMenu("Member", "users", "member", "admin.member"),
        sidebarMenu("Officer", "user-secret", "office", "admin.officer"),
        sidebarMenu("Division", "user-secret", "division", "admin.division"),
        sidebarMenu("Article", "file-alt", "article", "admin.article"),
        sidebarMenu("Documentation", "camera", "documentation", "admin.documentation"),
        sidebarMenu("Mailbox", "envelope", "mail", "admin.mailbox"),
        sidebarMenu("Open Recruitment", "user-cog", "open-recruitment.admin.index", "admin.event.or", [
            sidebarDropMenu("Peserta", "open-recruitment.admin.index"),
            sidebarDropMenu("Pengaturan", "open-recruitment.admin.setting"),
        ]),
    ];
}

function sidebarMenu($name = '', $icon = '', $route = '', $permission = '', $dropmenu = []) {
    return [
        "name" => $name,
        "icon" => $icon,
        "route" => $route,
        "permission" => $permission,
        "dropmenu" => $dropmenu,
    ];
}

function sidebarDropMenu($name, $route) {
    return [
        "name" => $name,
        "route" => $route,
    ];
}