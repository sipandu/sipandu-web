<?php

namespace App\Console;

use App\Jobs\BotCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Kegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     $now = Carbon::now();
        //     $kegiatan = Kegiatan::where('start_at', '>', $now->format('Y-m-d'))
        //         ->where('start_at', '<', $now->addDays(2)->format('Y-m-d'))->get();
        //     if($kegiatan->count() > 0) {
        //         foreach($kegiatan as $item) {
        //             $item->SchedulerH_2();
        //         }
        //     }
        // })->daily();

        $schedule->call(function () {
            $data = Http::get('http://127.0.0.1:8000/api/bot/getUpdates');
            if(isset($data)) {
                $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
                $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
                $response = Http::post($url, [
                    'chat_id' => '759889734',
                    'text' => 'hello world'
                ]);
            }
        })->everyMinute();
    }

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule)
    {
        // this artisan command will run every second
        $shortSchedule->command('bot:get-updates')->everySeconds(5);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
