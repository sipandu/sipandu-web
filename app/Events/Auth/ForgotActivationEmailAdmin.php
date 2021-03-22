<?php

namespace App\Events\Auth;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Admin;

class ForgotActivationEmailAdmin
{
    use Dispatchable,  SerializesModels;

    public $admin;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }


}
