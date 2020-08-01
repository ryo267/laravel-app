<?php

namespace App\Events;

use App\Events\UserUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdateListener
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
     * @param  UserUpdate  $event
     * @return void
     */
    public function handle(UserUpdate $event)
    {
        //
    }
}
