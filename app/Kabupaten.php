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
        return $this->hasMany('App\Kecamatan','id_kabupaten','id');
    }
}
