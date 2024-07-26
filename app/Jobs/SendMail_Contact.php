<?php

namespace App\Jobs;

use App\Mail\SendContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail_Contact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $username;
    protected $content;

    public function __construct($email, $username,$content)
    {
        $this->email = $email;
        $this->username = $username;
        $this->content = $content;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email_admin = "daothikhuyen30@gmail.com";
        Mail::to($email_admin)->send(new SendContact($this->email,$this->username,$this->content));
    }
}
