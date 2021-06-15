<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\AdminPermission;
use App\Admin;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function semuaPermission()
    {
        $permission = Permission::orderBy('nama_permission', 'asc')->get();
        $admin_permission = AdminPermission::get();

        return view('admin.permission.semua-permission', compact('permission', 'admin_permission'));
    }

    public function initialPermission(Permission $permission)
    {
        $admin_permission = AdminPermission::where('id_permission', $permission->id)->select('id_admin')->get();
        $admin = Admin::where('is_verified', '1')->whereNotIn('id', $admin_permission->toArray())->get();

        return view('admin.permission.initial-permission', compact('permission', 'admin', 'admin_permission'));
    }

    public function simpanPermission(Request $request, Permission $permission)
    {
        $request->validate([
            'email.*' => "required|email",
        ],[
            'email.*.required' => "Akun pengguna akses wajib ditambahkan",
            'email.*.email' => "Akun pengguna akses harus berupa email",
        ]);

        foreach ($request->admin as $data => $value) {
            $admin = AdminPermission::create([
                'id_admin' => $request->admin[$data],
                'id_permission' => $permission->id,
            ]);
        }

        if ($admin) {
            return redirect()->back()->with(['success' => 'Hak Akses Pengguna Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['success' => 'Hak Akses Pengguna Gagal Ditambahkan']);
        }
    }

    public function hapusAkses(AdminPermission $adminPermission)
    {   
        $admin_permission = AdminPermission::where('id', $adminPermission->id)->delete();

        if ($admin_permission) {
            return redirect()->back()->with(['success' => 'Hak Akses Pengguna Berhasil Dihapus']);
        } else {
            return redirect()->back()->with(['failed' => 'Hak Akses Pengguna Gagal Dihapus']);
        }
    }
}
