<?php

namespace App\Bot;

use App\InformasiPenting;
use Illuminate\Support\Facades\Http;
use App\Command;
class InformationCommand
{
    protected $url_bot = 'http://127.0.0.1:5002/updated-chat-in';

    public function __construct($command, $chat, $id_chat_in, $chat_id, $command_id)
    {
        $this->command = $command;
        $this->chat = $chat;
        $this->id_chat_in = $id_chat_in;
        $this->chat_id = $chat_id;
        $this->command_id = $command_id;
    }

    public function sendMessage()
    {
        if ($this->command == '/informasi') {
            $this->sendListFiturInformation();
        } elseif ($this->command == '/informasi_terbaru') {
            $this->sendNewsestInformation();
        }
    }

    public function sendListFiturInformation()
    {
        $command_child = Command::where('is_full_edited', '!=', '1')->where('parent_id', $this->command_id)->get();
        $msg = $this->chat;
        foreach($command_child as $item) {
            $msg = $msg . PHP_EOL . $item->command . ' => ' . $item->desc_fitur;
        }
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->chat_id,
            'chat' => $msg,
            'command' => $this->command,
            'id_chat_in' => $this->id_chat_in
        ]);
    }

    public function sendNewsestInformation()
    {
        $informasi = InformasiPenting::query()->orderby('created_at', 'desc')->limit(5)->get();
        $data_chat = "INFORMASI TERBARU".PHP_EOL;

        foreach($informasi as $item) {
            $data_chat = $data_chat . PHP_EOL . $item->judul_informasi . ' ('. $item->tanggal . ')' . PHP_EOL . $item->getLink() . PHP_EOL;
        }

        $response = Http::get($this->url_bot, [
            'chat_id' => $this->chat_id,
            'chat' => $data_chat,
            'command' => $this->command,
            'id_chat_in' => $this->id_chat_in
        ]);

    }
}