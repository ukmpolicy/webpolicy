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
        sidebarMenu("Akses Pengguna", "user-shield", "role", "admin.role"),
        sidebarMenu("Anggota", "users", "member", "admin.member"),
        sidebarMenu("Pengurus", "user-tie", "office", "admin.officer"),
        sidebarMenu("Bidang", "sitemap", "division", "admin.division"),
        sidebarMenu("Blog", "file-alt", "article", "admin.article"),
        sidebarMenu("Dokumentasi", "camera", "documentation", "admin.documentation"),
        sidebarMenu("Kotak Surat", "envelope", "mail", "admin.mailbox"),
        sidebarMenu("Rekrutmen", "house-user", "open-recruitment.admin.index", "admin.event.or", [
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