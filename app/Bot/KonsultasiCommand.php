<?php

namespace App\Bot;

use App\Command;
use App\KonsultasiTemp;
use App\RegisterBot;
use Illuminate\Support\Facades\Http;
class KonsultasiCommand
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
        if ($this->command->command == '/mulai_konsultasi') {
            $this->login();
        } elseif ($this->command->command == '/cek_token') {
            $this->cekToken();
        } else {
            if ($this->command->is_question == '1' && $this->command->is_answer == '0') {
                $this->sendPertanyaan();
            } else {
                if ($this->command->is_numeric == '1') {
                    if (is_numeric($this->data['chat'])) {
                        $this->storeJawaban();
                    } else {
                        $response = Http::get($this->url_bot, [
                            'chat_id' => $this->data['chat_id'],
                            'chat' => 'Data Invalid, Data yang dimasukkan harus angka!',
                            'command' => $this->command->command,
                            'id_chat_in' => $this->data['id']
                        ]);
                        $response = Http::get($this->url_bot, [
                            'chat_id' => $this->data['chat_id'],
                            'chat' => 'Masukkan ulang '.$this->command->key. ' dengan format '.$this->command->command . '{'.$this->command->key.'}',
                            'command' => $this->command->command,
                            'id_chat_in' => $this->data['id']
                        ]);
                    }
                } else {
                    $this->storeJawaban();
                }
            }
            // $this->cekJikaAdaPertanyaan();
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
            // sleep(2);
            // $this->cekJikaAdaPertanyaan();
            $child_command = Command::where('parent_id', $this->command->id)->first();
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => $child_command->chat,
                'command' => $child_command->command,
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

    public function sendPertanyaan()
    {
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => $this->command->chat,
            'command' => $this->command->command,
            'id_chat_in' => $this->data['id']
        ]);
    }

    public function storeJawaban()
    {
        $register_bot = RegisterBot::where('id_chat_tele', $this->data['chat_id'])->first();
        $konsultasi_temp = KonsultasiTemp::where('id_user', $register_bot->user_id)->where('is_end', '0')->first();
        $data = [];
        if(isset($konsultasi_temp)) {
            $data = json_decode($konsultasi_temp->value, true);
            $data[$this->command->key] = $this->data['chat'];
            $konsultasi_temp->value = json_encode($data);
            $konsultasi_temp->save();
        } else {
            $data[$this->command->key] = $this->data['chat'];
            $konsultasi_temp = new KonsultasiTemp();
            $konsultasi_temp->id_user = $register_bot->user_id;
            $konsultasi_temp->chat_id = $this->data['chat_id'];
            $konsultasi_temp->is_end = '0';
            $konsultasi_temp->value = json_encode($data);
            $konsultasi_temp->save();
        }
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => $this->command->chat,
            'command' => $this->command->command,
            'id_chat_in' => $this->data['id']
        ]);

        $this->cekJikaAdaPertanyaan();
    }

    public function cekJikaAdaPertanyaan()
    {
        $child_command = Command::where('parent_id', $this->command->id)->first();

        if (isset($child_command)) {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => $child_command->chat,
                'command' => $child_command->command,
                'id_chat_in' => $this->data['id']
            ]);
        } else {
            $register_bot = RegisterBot::where('id_chat_tele', $this->data['chat_id'])->first();
            $konsultasi_temp = KonsultasiTemp::where('id_user', $register_bot->user_id)->where('is_end', '0')->first();
            $konsultasi_temp->is_end = '1';
            $konsultasi_temp->save();
            $this->konfirmasiKonsultasi();
            // $response = Http::get($this->url_bot, [
            //     'chat_id' => $this->data['chat_id'],
            //     'chat' => "Konsultasi Selesai, hasil akan dikirimkan berupa file",
            //     'command' => $this->command->command,
            //     'id_chat_in' => $this->data['id']
            // ]);
        }
    }

    public function konfirmasiKonsultasi()
    {
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Input Ulang', 'callback_data' => '/hello'],
                    ['text' => 'Sudah Benar', 'callback_data' => '/hello']
                ]
            ]
        ];

        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => "Apakah Data Sudah benar?",
            'command' => $this->command->command,
            'id_chat_in' => $this->data['id'],
            'reply_markup' => json_encode($keyboard)
        ]);
    }

}