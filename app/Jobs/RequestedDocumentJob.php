<?php

namespace App\Jobs;

use App\Events\ProcessRequestedDocument;
use App\Listeners\ProcessRequestedDocumentMessage;
use App\Mail\RequestedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RequestedDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $unique_code;
    protected $name;
    protected $brgy;

    public function __construct($email,$unique_code,$name,$brgy)
    {
 

        $this->email = $email;
        $this->unique_code = $unique_code;
        $this->name = $name;
        $this->brgy = $brgy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        // $uq = $this->event->unique_code;
        // $name = $this->event->name;
        // $brgy = $this->event->brgy;
        
        // dd($this->email, $this->unique_code, $this->name, $this->brgy);
        
        
       
        Mail::to($this->email)->send(new RequestedDocument($this->unique_code,$this->name,$this->brgy));

        // Mail::to($this->event->email)->send(new RequestedDocument($uq,$name,$brgy));
    }
}
