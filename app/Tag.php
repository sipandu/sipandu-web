<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tb_tag';

    protected $fillable = [
        'nama_tag',
        'status',
    ];

    public function tagBerita()
    {
        return $this->hasMany(TagBerita::class,'id_tag','id');
    }
}
