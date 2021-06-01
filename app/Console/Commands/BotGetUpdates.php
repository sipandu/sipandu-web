<?php

namespace App\Console\Commands;

use App\BotCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\TableCommand;

class BotGetUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:get-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $response = Http::get('http://127.0.0.1:5002/getUpdates');
        // ob_start();
        // var_dump($response);
        // $log = ob_get_clean();
        // // $response->
        // logger("data", [$log]);
        if (isset($response)) {
            $bot = new BotCommand($response[0]);
            if ($response[0]['type'] == 'sendMessage') {
                $bot->sendMessage();
            }
        }
    }
}
