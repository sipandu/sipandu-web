<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KK extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_kk';

    protected $fillable = [
        'no_kk',
        'file_kk',
    ];

    public function user(){
        return $this->hasMany('App\User','id_kk','id');
    }

}
