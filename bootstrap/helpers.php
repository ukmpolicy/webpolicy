<?php

use App\Models\Period;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;

function getIdActivePeriod() {
    return (Period::getPeriodeActive()) ? Period::getPeriodeActive()->id : null;
}

function hasPermission($role_id, $permission_id) {
    return !is_null(RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first());
}

function hasPermissionByName($permission) {
    $role_id = auth()->user()->role_id;
    $permission = Permission::where('name', $permission)->first();
    $permission_id = ($permission) ? $permission->id : null;
    return !is_null(RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first());
}

function getURLPath($url) {
    return substr(parse_url($url)['path'], 1);
}

function getSidebarMenu() {
    return [
        sidebarMenu("Dashboard", "tachometer-alt", "dashboard", "admin.dashboard"),
        // sidebarMenu("Akses Pengguna", "user-shield", "role", "admin.role"),
        // sidebarMenu("Anggota", "users", "member", "admin.member"),
        sidebarMenu("Kepengurusan", "user-tie", "office", "", [
            sidebarDropMenu("Anggota", "member", "admin.member"),
            sidebarDropMenu("Divisi", "division", "admin.division"),
            sidebarDropMenu("Pengurus", "office", "admin.officer"),
            sidebarDropMenu("Periode", "period", "admin.period"),
            sidebarDropMenu("Jabatan", "position", "admin.position"),
            // sidebarDropMenu("Periode", "open-recruitment.admin.index"),
        ]),
        // sidebarMenu("Pengurus", "user-tie", "office", "admin.officer"),
        // sidebarMenu("Bidang", "sitemap", "division", "admin.division"),
        sidebarMenu("Media", "file-alt", "article", "admin.article", [
            sidebarDropMenu("Blog", "article", "admin.article"),
            sidebarDropMenu("Dokumentasi", "documentation", "admin.documentation"),
            sidebarDropMenu("Kota Surat", "mail", "admin.mailbox"),
        ]),
        // sidebarMenu("Blog", "file-alt", "article", "admin.article"),
        // sidebarMenu("Dokumentasi", "camera", "documentation", "admin.documentation"),
        // sidebarMenu("Kotak Surat", "envelope", "mail", "admin.mailbox"),
        sidebarMenu("Rekrutmen", "house-user", "open-recruitment.admin.index", "admin.event.or", [
            sidebarDropMenu("Peserta", "open-recruitment.admin.index", "admin.event.or"),
            sidebarDropMenu("Pengaturan", "open-recruitment.admin.setting", "admin.event.or"),
        ]),
        sidebarMenu("Pengaturan", "cogs", "role", "admin.role", [
            sidebarDropMenu("Akses Pengguna", "role", "admin.role"),
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

function hasMenuPermission($group_name) {
    $hasPermission = false;
    foreach (getSidebarMenu() as $v) {
        if ($v['name'] == $group_name) {
            foreach ($v['dropmenu'] as $dm) {
                if (hasPermissionByName($dm['permission'])) {
                    $hasPermission = true;
                }
            }
        }
    }
    return $hasPermission;
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

function sidebarDropMenu($name, $route, $permission = '') {
    return [
        "name" => $name,
        "route" => $route,
        "permission" => $permission,
    ];
}