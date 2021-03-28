<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ForgotActivationEmailUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Auth\ForgotPasswordUser;
use Mail;
use Redirect,Response,DB,Config;

class SendActivationEmailForgotUser
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
     * @param  ForgotActivationEmailUser  $event
     * @return void
     */
    public function handle(ForgotActivationEmailUser $event)
    {
        $event->user;

        Mail::to($event->user->email)->send(new ForgotPasswordUser($event->user));
    }
}
