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
    public function __construct($ub,$name,$brgyName)
    {
        $this->ub = $ub;
        $this->name = $name;
        $this->brgyName = $brgyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.qrmessage')->with([
            'ub' => $this->ub,
            'name' => $this->name,
            'brgyName' => $this->brgyName,
        ]);
    }
}
