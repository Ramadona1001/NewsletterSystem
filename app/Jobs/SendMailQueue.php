<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendContactMail;
use Illuminate\Support\Facades\Mail;

class SendMailQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $from_name;
    public $email;
    public $subject;
    public $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($from_name,$email,$subject,$content)
    {
        $this->from_name = $from_name;
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subcribeMail = new SendContactMail($this->from_name,$this->email,$this->subject,$this->content);
        Mail::to($this->email)->send($subcribeMail);
    }
}
