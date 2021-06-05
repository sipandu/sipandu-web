<?php

namespace App;

use App\Bot\GreetingCommand;
use App\Bot\InformationCommand;
use App\Bot\KonsultasiCommand;
use App\Bot\RegisterUserCommand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class BotCommand extends Model
{
    protected $url_bot = 'http://127.0.0.1:5002/updated-chat-in';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sendMessage()
    {
        if(isset($this->data)) {
            $command = TableCommand::where('command', 'LIKE', '%'.$this->data['command'].'%')->first();
            if (isset($command)) {
                if ($command->model == 'GreetingCommand::class') {
                    $this->sendGreeting($command);
                } else if($command->model == 'InformationCommand::class') {
                    $this->sendInformation($command);
                } else if($command->model == 'RegisterUserCommand::class') {
                    $this->sendRegisterCommand($command);
                } else if($command->model == 'KonsultasiCommand::class') {
                    $this->sendKonsultasiCommand($command);
                }
                else {
                    $this->singleMessage($command);
                }
            } else {
                $response = Http::get($this->url_bot, [
                    'chat_id' => $this->data['chat_id'],
                    'chat' => "Tidak ada command yang diterdaftar, anda dapat menggunakan beberapa command dibawah",
                    'command' => '/no_command',
                    'id_chat_in' => $this->data['id']
                ]);
                $command_hello = TableCommand::where('command', '/hello')->first();
                $this->singleMessage($command_hello);
            }
        }
    }

    public function sendGreeting($command)
    {
        $greeting = new GreetingCommand($command->command, $this->data['chat'], $this->data['id'], $this->data['chat_id']);
        $greeting->sendMessage();
    }

    public function sendInformation($command)
    {
        $greeting = new InformationCommand($command->command, $command->chat, $this->data['id'], $this->data['chat_id']);
        $greeting->sendMessage();
    }

    public function sendRegisterCommand($command)
    {
        $greeting = new RegisterUserCommand($command , $this->data);
        $greeting->sendMessage();
    }

    public function sendKonsultasiCommand($command)
    {
        $greeting = new KonsultasiCommand($command , $this->data);
        $greeting->sendMessage();
    }

    public function singleMessage($command)
    {
        $response = Http::get($this->url_bot, [
            'chat_id' => $this->data['chat_id'],
            'chat' => $command->chat,
            'command' => $command->command,
            'id_chat_in' => $this->data['id']
        ]);
    }

}
