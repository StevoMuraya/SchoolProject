<?php

namespace App\Mail;

use App\Models\students;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentRegEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $student;
    public $new_pass;
    public function __construct($student, $new_pass)
    {
        $this->student = $student;
        $this->new_pass = $new_pass;

        // dd($this);
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
            ->view('student-Reg-Email');
    }
}
