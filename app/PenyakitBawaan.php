<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyakitBawaan extends Model
{
    protected $table = 'tb_penyakit_bawaan';

    protected $fillable = [
        'id_user',
        'nama_penyakit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
