<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LecturerRegEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $lecturer;
    public $new_pass;
    public function __construct($lecturer, $new_pass)
    {
        $this->lecturer = $lecturer;
        $this->new_pass = $new_pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('lecturer-Reg-Email');
    }
}
