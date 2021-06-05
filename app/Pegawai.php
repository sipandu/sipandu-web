<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_pegawai';

    protected $fillable = [
        'id_posyandu',
        'id_admin',
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'jabatan',
        'username_telegram',
        'nik',
        'status',
        'file_ktp',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }
}
