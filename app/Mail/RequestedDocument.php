<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestedDocument extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uq,$name,$brgy)
    {
        $this->uq = $uq;
        $this->name = $name;
        $this->brgy = $brgy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.processeddoc')->with([
            'uq' => $this->uq,
            'name' => $this->name,
            'brgy' => $this->brgy,
        ]);
    }
}
