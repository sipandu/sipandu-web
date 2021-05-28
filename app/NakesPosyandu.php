<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NakesPosyandu extends Model
{
    protected $table = 'tb_nakes_posyandu';

    protected $fillable = [
        'id_posyandu',
        'id_nakes',
    ];

    public function posyandu(){
        return $this->belongsTo(Posyandu::class,'id_posyandu','id');
    }

    public function nakes(){
        return $this->belongsTo(Admin::class,'id_nakes','id');
    }
}
