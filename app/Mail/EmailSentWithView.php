<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSentWithView extends Mailable
{
    use Queueable, SerializesModels;

    //private $tenant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->from("agencylinking@gmail.com",config('app.name'))->view("emails.abc");
        //return $this->view('view.name');
        return $this->from('agencylinking@gmail.com')->view('welcome');
    }
}
