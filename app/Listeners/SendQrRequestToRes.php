<?php

namespace App\Listeners;

use App\Events\SubmitRequest;
use App\Mail\ResidentQrMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendQrRequestToRes
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SubmitRequest $event)
    {
        $uq = $event->unique_code;
        $name = $event->name;
        $brgyName = $event->brgyName;
        Mail::to($event->email)->send(new ResidentQrMessage($uq,$name,$brgyName));
    }
}
