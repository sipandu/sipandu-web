<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergi extends Model
{
    protected $table = 'tb_alergi';

    protected $fillable = [
        'id_user',
        'nama_alergi',
        'kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
