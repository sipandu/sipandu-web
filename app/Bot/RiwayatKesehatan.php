<?php

namespace App\Bot;

use App\Command;
use App\RegisterBot;
use Illuminate\Support\Facades\Http;

class RiwayatKesehatan
{
    protected $url_bot = 'http://127.0.0.1:5002/updated-chat-in';

    private $command;

    public function __construct($command, $data)
    {
        $this->command = $command;
        $this->data = $data;
    }

    public function sendMessage()
    {
        if ($this->command->command == '/cek_riwayat_kesehatan') {
            $this->login();
        } elseif ($this->command->command == '/cek_token_riwayat') {
            $this->cekToken();
        }
    }

    public function login()
    {
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => $this->command->chat,
            'command' => $this->command->command,
            'id_chat_in' => $this->data['id']
        ]);
    }

    public function cekToken()
    {
        $register_bot = RegisterBot::where('token', $this->data['chat'])->first();
        if (isset($register_bot)) {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => $this->command->chat,
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        } else {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => "Akun Telegram belum terdaftar, daftarkan akun telegram anda dengan command /register",
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        }
    }

}