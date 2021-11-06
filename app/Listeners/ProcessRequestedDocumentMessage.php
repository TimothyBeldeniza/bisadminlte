<?php

namespace App\Listeners;

use App\Events\ProcessRequestedDocument;
use App\Jobs\RequestedDocumentJob;
use App\Mail\RequestedDocument;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ProcessRequestedDocumentMessage
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
    public function handle(ProcessRequestedDocument $event)
    {
        // dd($event->email[0]);
        Mail::to($event->email)->send(new RequestedDocument);
        // dispatch(new RequestedDocumentJob());
    }
}
