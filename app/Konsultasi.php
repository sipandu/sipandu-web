<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'tb_konsultasi';

    public function cekStatus()
    {
        $status = '';
        if ($this->is_confirm == '1') {
            $status = 'Sudah diperiksa';
        } else {
            $status = 'Belum diperiksa';
        }

        return $status;
    }

    public function cekStatusTerkirim()
    {
        $status = 'Belum Terkirim';
        if ($this->is_sent == '1') {
            $status = 'Telah Dikirimkan';
        }

        return $status;
    }
}
