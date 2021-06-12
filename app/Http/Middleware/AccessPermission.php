<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Admin;
use App\Permission;
use App\AdminPermission;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $expression)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $permission_id = Permission::where('nama_permission', $expression)->first();

        // Check permission
        $permission = AdminPermission::where('id_admin', $admin_id)->where('id_permission', $permission_id->id)->first();
        if ($permission) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
