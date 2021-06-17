<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kabupaten extends Model
{
    use Notifiable;

    protected $table = 'tb_kabupaten';

    protected $fillable = [
        'nama_kabupaten',
    ];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten', 'id');
    }

    public function superAdmin()
    {
        return $this->hasMany(SuperAdmin::class,'id_posyandu','id');
    }
}
