<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Admin;
use App\Permission;
use App\AdminPermission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        Blade::if('permission', function ($expression) {
            $admin_id = Auth::guard('admin')->user()->id;
            $permission_id = Permission::where('nama_permission', $expression)->first();

            // Check permission
            $permission = AdminPermission::where('id_admin', $admin_id)->where('id_permission', $permission_id->id)->first();
            if ($permission) {
                return true;
            }
        });

        Blade::if('menu', function ($expression) {
            $admin_id = Auth::guard('admin')->user()->id;
            $permission_id = Permission::whereIn('nama_permission', $expression)->select('id')->get();
            $permission = AdminPermission::where('id_admin', $admin_id)->whereIn('id_permission', $permission_id->toArray())->first();

            if($permission != NULL){
                return true;
            }
        });
    }
}
