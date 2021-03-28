<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// <<<<<<< loginRegis
use Illuminate\Notifications\Notifiable;

class Posyandu extends Model
{
    use Notifiable;

    protected $table = 'tb_posyandu';

    protected $fillable = [
        'id_desa',
        'id_admin',
        'nama_posyandu',
        'id_chat_group_tele',
        'alamat',
        'nomor_telepon',
        'banjar',
        'latitude',
        'longitude',
    ];

    public function penyuluhan()
    {
        return $this->hasMany(Penyuluhan::class, 'id_posyandu');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_posyandu');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_posyandu');
    }

    public function anak(){
        return $this->hasMany('App\Anak','id_posyandu','id');
    }

    public function ibu(){
        return $this->hasMany('App\Ibu','id_posyandu','id');
    }

    public function lansia(){
        return $this->hasMany('App\Lansia','id_posyandu','id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    // public function posyandu()
    // {
    //     return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    // }




// =======

// class Posyandu extends Model
// {
//     protected $table = 'tb_posyandu';

//     protected $fillable = [
//         'id_desa', 'id_admin', 'id_chat_group_tele', 'telegram_group_invite', 'nama_posyandu', 'alamat', 'nomor_telepon', 'banjar', 'latitude', 'longitude'
//     ];


// >>>>>>> main
}
