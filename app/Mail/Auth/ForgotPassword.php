<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Admin;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->Subject('Reset Password - Posyandu 5.0')->markdown('pages.auth.admin.password.email')->with('admin',$this->admin);
    }
}
