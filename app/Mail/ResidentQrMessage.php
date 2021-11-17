<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentQrMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uq,$name,$brgyName,$document)
    {
        $this->uq = $uq;
        $this->name = $name;
        $this->brgyName = $brgyName;
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.qrmessage')->with([
            'uq' => $this->uq,
            'name' => $this->name,
            'brgyName' => $this->brgyName,
            'document' => $this->document,
        ]);
    }
}
