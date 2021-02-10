<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;    

class WelcomeNewCustomerListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
     
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->customer['email'])->send(new WelcomeMail()); //step 1
    }
}
