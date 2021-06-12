<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\AdminPermission;
use App\Admin;

class PermissionController extends Controller
{
    public function semuaPermission()
    {
        $permission = Permission::get();
        $admin_permission = AdminPermission::get();

        return view('admin.permission.semua-permission', compact('permission', 'admin_permission'));
    }

    public function initialPermission(Permission $permission)
    {
        $admin_permission = AdminPermission::where('id_permission', $permission->id)->get();
        $admin = Admin::get();
        
        $id_admin_permission = AdminPermission::where('id_permission', $permission->id)->pluck('id_admin');
        $id_admin = [];

        foreach ($id_admin_permission as $data => $value) {
            $id_admin[] = $id_admin_permission[$data];
        }

        return view('admin.permission.initial-permission', compact('permission', 'admin_permission', 'admin', 'id_admin'));
    }
}
