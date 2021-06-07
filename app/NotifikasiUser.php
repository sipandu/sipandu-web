<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifikasiUser extends Model
{
    protected $table = 'tb_notifikasi';

    protected $fillable = [
        'notif_title',
        'id_user',
        'notif_content',
        'read_flag',
    ];

    public function notifUser(){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
