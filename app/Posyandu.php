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

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }

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

    // public function desa()
    // {
    //     return $this->belongsTo('App\desa');
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
