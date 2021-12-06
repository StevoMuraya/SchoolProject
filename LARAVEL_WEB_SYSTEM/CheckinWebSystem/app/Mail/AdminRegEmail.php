<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminRegEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $new_pass;
    public function __construct($user, $new_pass)
    {
        $this->user = $user;
        $this->new_pass = $new_pass;
        // dd($this)
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('admin@checkin.co.ke', 'Checkin System Admin')
            ->view('Admin-Reg-Email');
    }
}
