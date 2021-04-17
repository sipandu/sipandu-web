<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Posyandu extends Model
{
    use Notifiable;

    protected $table = 'tb_posyandu';

    protected $fillable = [
        'id_desa',
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

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'id_posyandu');
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

    public function pemberianImunisasi()
    {
        return $this->hasMany('PemberianImunisasi','id_posyandu','id');
    }
}
