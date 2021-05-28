<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nakes extends Model
{
    protected $table = 'tb_nakes';

    protected $fillable = [
        'id_admin',
        'nama_nakes',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'username_telegram',
        'nik',
        'file_ktp',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'id_admin','id');
    }

    public function nakesPosyandu()
    {
        return $this->hasMany(NakesPosyandu::class,'id_nakes','id');
    }
}
