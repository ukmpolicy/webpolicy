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
        // sidebarMenu("Akses Pengguna", "user-shield", "role", "admin.role"),
        // sidebarMenu("Anggota", "users", "member", "admin.member"),
        sidebarMenu("Kepengurusan", "user-tie", "office", "admin.officer", [
            sidebarDropMenu("Anggota", "member"),
            sidebarDropMenu("Divisi", "division"),
            sidebarDropMenu("Pengurus", "office"),
            sidebarDropMenu("Periode", "period"),
            sidebarDropMenu("Jabatan", "position"),
            // sidebarDropMenu("Periode", "open-recruitment.admin.index"),
        ]),
        // sidebarMenu("Pengurus", "user-tie", "office", "admin.officer"),
        // sidebarMenu("Bidang", "sitemap", "division", "admin.division"),
        sidebarMenu("Media", "file-alt", "article", "admin.article", [
            sidebarDropMenu("Blog", "article"),
            sidebarDropMenu("Dokumentasi", "documentation"),
            sidebarDropMenu("Kota Surat", "mail"),
        ]),
        // sidebarMenu("Blog", "file-alt", "article", "admin.article"),
        // sidebarMenu("Dokumentasi", "camera", "documentation", "admin.documentation"),
        // sidebarMenu("Kotak Surat", "envelope", "mail", "admin.mailbox"),
        sidebarMenu("Rekrutmen", "house-user", "open-recruitment.admin.index", "admin.event.or", [
            sidebarDropMenu("Peserta", "open-recruitment.admin.index"),
            sidebarDropMenu("Pengaturan", "open-recruitment.admin.setting"),
        ]),
        sidebarMenu("Pengaturan", "cogs", "role", "admin.role", [
            sidebarDropMenu("Akses Pengguna", "role"),
        ]),
    ];
}

function containsInDropMenu($group_name, $route) {
    foreach (getSidebarMenu() as $v) {
        if ($v['name'] == $group_name) {
            foreach ($v['dropmenu'] as $dm) {
                if ($dm['route'] == $route) {
                    return true;
                }
            }
        }
    }
    return false;
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