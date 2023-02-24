<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class SendVerificationEmail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $user;
    public $code;
    public $data;


    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $code,$data)
    {
        $this->user = $user;
        $this->code = $code;
        $this->data = $data;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->user;
    $code = $this->code;
    $data = $this->data;

    Mail::to($user->email)->send(new VerifyEmail($data));
    }
}
