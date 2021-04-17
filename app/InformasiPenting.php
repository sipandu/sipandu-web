<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformasiPenting extends Model
{
    protected $table = 'tb_informasi';

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id', 'id');
    }


    public function getUrlImage() {
        return url('/admin/informasi-penting/get-img/'.$this->id);
    }
}
