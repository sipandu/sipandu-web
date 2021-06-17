<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'tb_permission';

    protected $fillable = [
        'nama_permission',
    ];
    
    public function adminPermission()
    {
        return $this->hasMany(AdminPermission::class,'id_permission','id');
    }
}
