<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailContactus extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $email;
    private $pno;
    private $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->markdown('emails.markdown.emailcontactus')
            ->with('name', $request->name)
            ->with('email', $request->email)
            ->with('phone', $request->phone)
            ->with('message', $request->message);
    }
}
