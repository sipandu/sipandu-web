<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'tb_posyandu';

    public function penyuluhan()
    {
        return $this->hasMany(Penyuluhan::class, 'id_posyandu');
    }
}
