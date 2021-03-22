<?php

namespace App\Events\Auth;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;

class ForgotActivationEmailUser
{
    use Dispatchable,  SerializesModels;

    public $admin;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }


}
