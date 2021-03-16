<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// <<<<<<< loginRegis
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
        return $this->hasMany(Kecamatan::class, 'id_kabupaten');
    }
// =======

// class Kabupaten extends Model
// {
//     protected $table = 'tb_kabupaten';

//     public function kecamatan()
//     {
//         return $this->hasMany(Kecamatan::class, 'id_kabupaten');
// >>>>>>> main
//     }
}
