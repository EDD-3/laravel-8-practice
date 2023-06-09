<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

//Class to send all mail to mailtrap
class ThrottledMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //The amount of tries 
    //the job has to be run
    public $tries = 15;

    //In seconds before the job 
    public $timeout = 30;

    public $mail;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mailable $mail, User $user)
    {
        //
        $this->mail = $mail;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //The key has to be unique
        Redis::throttle('mailtrap')->allow(2)->every(12)->then(function () {
            //Job logic

            Mail::to($this->user)->send($this->mail);
        }, function () {
            //Could not obtain logic

            return $this->release(10);
        }
    );
    }
}
