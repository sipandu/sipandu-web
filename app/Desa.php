<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// <<<<<<< loginRegis
use Illuminate\Notifications\Notifiable;

class Desa extends Model
{
    use Notifiable;

    protected $table = 'tb_desa';

    protected $fillable = [
        'id_kecamatan',
        'nama_desa',
    ];

    public function posyandu()
    {
        return $this->hasMany(Posyandu::class,'id_desa');
    }

    // public function kegiatan()
    // {
    //     return $this->hasMany(Kegiatan::class, 'id_posyandu');
    // }

    public function kecamatan()
    {
        return $this->belongsTo('App\kecamatan');
    }
// =======

// class Desa extends Model
// {
//     protected $table = 'tb_desa';
// >>>>>>> main
}
