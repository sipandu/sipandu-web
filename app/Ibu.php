<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ibu extends Model
{
    use Notifiable;

    protected $table = 'tb_ibu_hamil';

    protected $fillable = [
        'id_posyandu',
        'id_user',
        'nama_ibu_hamil',
        'nama_suami',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'NIK',
    ];
}
