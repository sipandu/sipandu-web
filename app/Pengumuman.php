<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Pengumuman extends Model
{
    protected $table = 'tb_pengumuman';

    protected $fillable = [
        'id_posyandu',
        'judul_pengumuman',
        'pengumuman',
        'tanggal',
        'image',
        'slug',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function broadcastPengumumanToMember()
    {
        $url_anak = 'https://sipandu-test-web.herokuapp.com/anak';
        $url_ibu_hamil = 'https://sipandu-test-web.herokuapp.com/ibu';
        $url_lansia = 'https://sipandu-test-web.herokuapp.com/lansia';
        $anak = DB::table('tb_user')->join('tb_anak', 'tb_anak.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_anak.id_posyandu', $this->id_posyandu)
            ->get();
        $ibu_hamil = DB::table('tb_user')->join('tb_ibu_hamil', 'tb_ibu_hamil.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_ibu_hamil.id_posyandu', $this->id_posyandu)
            ->get();
        $lansia = DB::table('tb_user')->join('tb_lansia', 'tb_lansia.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_lansia.id_posyandu', $this->id_posyandu)
            ->get();
        $caption_anak = '[PENGUMUMAN BARU] '.$this->judul_pengumuman.PHP_EOL.$url_anak;
        $caption_bumil = '[PENGUMUMAN BARU] '.$this->judul_pengumuman.PHP_EOL.$url_ibu_hamil;
        $caption_lansia = '[PENGUMUMAN BARU] '.$this->judul_pengumuman.PHP_EOL.$url_lansia;
        foreach($anak as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_anak);
        }

        foreach($lansia as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_lansia);
        }

        foreach($ibu_hamil as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_bumil);
        }

        return true;
    }

    public function broadcastUpdatePengumumanToMember()
    {
        $url_anak = 'https://sipandu-test-web.herokuapp.com/anak';
        $url_ibu_hamil = 'https://sipandu-test-web.herokuapp.com/ibu';
        $url_lansia = 'https://sipandu-test-web.herokuapp.com/lansia';
        $anak = DB::table('tb_user')->join('tb_anak', 'tb_anak.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_anak.id_posyandu', $this->id_posyandu)
            ->get();
        $ibu_hamil = DB::table('tb_user')->join('tb_ibu_hamil', 'tb_ibu_hamil.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_ibu_hamil.id_posyandu', $this->id_posyandu)
            ->get();
        $lansia = DB::table('tb_user')->join('tb_lansia', 'tb_lansia.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_lansia.id_posyandu', $this->id_posyandu)
            ->get();
        $caption_anak = '[UPDATE PENGUMUMAN] '.$this->judul_pengumuman.PHP_EOL.$url_anak;
        $caption_bumil = '[UPDATE PENGUMUMAN] '.$this->judul_pengumuman.PHP_EOL.$url_ibu_hamil;
        $caption_lansia = '[UPDATE PENGUMUMAN] '.$this->judul_pengumuman.PHP_EOL.$url_lansia;
        foreach($anak as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_anak);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_lansia);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $this->sendInformationToUser($item->id_chat_tele, $caption_bumil);
            sleep(2);
        }

        return true;
    }

    public function sendInformationToUser($id_chat, $caption)
    {
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendPhoto';
        $photo = 'https://sipandu-test-web.herokuapp.com/admin/pengumuman/get-img/'.$this->id;
        $response = Http::post($url, [
            'chat_id' => $id_chat,
            'photo' => $photo,
            'caption' => $caption
        ]);

    }

    public function testNoPhoto($id_chat)
    {
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendPhoto';
        $response = Http::post($url, [
            'chat_id' => $id_chat,
            'test' => 'ini test',
        ]);
    }

    public function getUrlImage() {
        return url('/api/mobileuser/get-pengumuman-img/'.$this->id);
    }
}
