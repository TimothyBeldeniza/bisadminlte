<?php

namespace App\Jobs;

use App\Mail\ResidentQrMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQrEmail implements ShouldQueue
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
    protected $brgyName;
    protected $document;

    public function __construct($email,$unique_code,$name,$brgyName,$document)
    {
        
        $this->email = $email;
        $this->unique_code = $unique_code;
        $this->name = $name;
        $this->brgyName = $brgyName;
        $this->document = $document;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ResidentQrMessage($this->unique_code,$this->name,$this->brgyName,$this->document));
    }
}
