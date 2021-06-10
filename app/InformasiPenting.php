<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class InformasiPenting extends Model
{
    protected $table = 'tb_informasi';

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id', 'id');
    }

    public function tagBerita()
    {
        return $this->hasMany(TagBerita::class,'id_tag','id');
    }


    public function getUrlImage() {
        return url('/api/mobileuser/get-informasi-img/'.$this->id);
    }

    public function broadcastToAllUser()
    {
        $user = User::select('tb_user.id_chat_tele')->where('id_chat_tele', '!=', NULL)->get();
        foreach($user as $item)
        {
            $caption = '[NEW] '.$this->judul_informasi.PHP_EOL.$this->getLink();
            $this->sendInformationToUser($item->id_chat_tele, $caption, $this->id);
        }

        return true;
    }

    public function broadcastUpdateToAllUser()
    {
        $user = User::select('tb_user.id_chat_tele')->where('id_chat_tele', '!=', NULL)->get();
        foreach($user as $item)
        {
            $caption = '[UPDATE] '.$this->judul_informasi.PHP_EOL.$this->getLink();
            $this->sendInformationToUser($item->id_chat_tele, $caption, $this->id);
            sleep(2);
        }

        return true;
    }

    public function sendInformationToUser($id_chat, $caption, $id_info)
    {
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendPhoto';
        $photo = 'https://sipandu-test-web.herokuapp.com/admin/informasi-penting/get-img/'.$id_info;
        $response = Http::post($url, [
            'chat_id' => $id_chat,
            'photo' => $photo,
            'caption' => $caption
        ]);

    }

    public function getLink()
    {
        return 'https://sipandu-test-web.herokuapp.com/blog/detail/'.$this->slug;
    }
}
