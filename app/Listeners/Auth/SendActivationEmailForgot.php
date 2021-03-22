<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ForgotActivationEmailAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Auth\ForgotPassword;
use Mail;
use Redirect,Response,DB,Config;

class SendActivationEmailForgot
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ForgotActivationEmailAdmin  $event
     * @return void
     */
    public function handle(ForgotActivationEmailAdmin $event)
    {
        $event->admin;

        Mail::to($event->admin->email)->send(new ForgotPassword($event->admin));
    }
}
