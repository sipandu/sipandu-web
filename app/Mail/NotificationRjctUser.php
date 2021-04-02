<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationRjctUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->Subject('Notifikasi Konfirmasi Akun')->from('SIPANDU@gmail.com')
                   ->markdown('pages.auth.admin.email.notifReject')
                   ->with(
                    [
                        'nama' => $this->user->email,
                        'keterangan' => $this->user->keterangan
                    ]);
    }
}
