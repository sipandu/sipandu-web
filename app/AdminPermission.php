<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'tb_admin_permission';

    protected $fillable = [
        'id_admin',
        'id_permission',
    ];

    public function permission(){
        return $this->belongsTo(Permission::class,'id_permission','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'id_admin','id');
    }
}
