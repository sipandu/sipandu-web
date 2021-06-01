<?php

namespace App\Bot;

use App\RegisterBot;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class RegisterUserCommand
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
        if ($this->command->command == '/register') {
            $this->sendFiturRegisterUser();
        } elseif ($this->command->command == '/daftar') {
            $this->checkAuthenticate();
        } elseif ($this->command->command == '/email') {
            $this->requestPassword();
        } elseif ($this->command->command == '/password') {
            $this->checkAuthenticate();
        }
    }

    public function sendFiturRegisterUser()
    {
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => $this->command->chat,
            'command' => $this->command->command,
            'id_chat_in' => $this->data['id']
        ]);
    }

    public function requestPassword()
    {
        $user = User::where('email', $this->data['chat'])->first();

        if (isset($user)) {
            $regis_bot = new RegisterBot();
            $regis_bot->id_chat_tele = $this->data['chat_id'];
            $regis_bot->jenis_user = 'user';
            $regis_bot->email = $this->data['chat'];
            $regis_bot->save();

            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => $this->command->chat,
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        } else {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => "Email belum terdaftar, masukkan kembali email /email {email}",
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        }
    }

    public function checkAuthenticate()
    {
        $register_bot = RegisterBot::where('id_chat_tele', $this->data['chat_id'])->first();

        $user = User::where('email', $register_bot->email)->first();

        if (Hash::check($this->data['chat'], $user->password)) {
            $token = Str::random(32);
            $register_bot->token = $token;
            $register_bot->user_id = $user->id;
            $register_bot->password = $user->password;
            $register_bot->id_chat_tele = $this->data['chat_id'];
            $register_bot->save();
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => $this->command->chat.PHP_EOL.'"'.$token.'"',
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        } else {
            $response = Http::get($this->url_bot, [
                'chat_id' => $this->data['chat_id'],
                'chat' => "Password salah, masukkan kembali password /password {password}",
                'command' => $this->command->command,
                'id_chat_in' => $this->data['id']
            ]);
        }
    }

}