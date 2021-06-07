<?php

namespace App\Bot;
use Illuminate\Support\Facades\Http;
class GreetingCommand
{
    protected $url_bot = 'http://127.0.0.1:5002/updated-chat-in';

    public function __construct($command, $chat, $id_chat_in, $chat_id)
    {
        $this->command = $command;
        $this->chat = $chat;
        $this->id_chat_in = $id_chat_in;
        $this->chat_id = $chat_id;
    }

    public function sendMessage()
    {
        if ($this->command == '/greeting') {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->chat_id,
                'chat' => 'Helo '.$this->chat,
                'command' => $this->command,
                'id_chat_in' => $this->id_chat_in
            ]);
        }
    }
}