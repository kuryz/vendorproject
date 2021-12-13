<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserEventListener
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
     * @param  UserEvent  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        // storing of the login history
        $current_timestamp = Carbon::now()->toDateTimeString(); 
        $userinfo = $event->user;
        $saveHistory = DB::table('login_history')->insert(
            [
                'user_id' => $userinfo->id, 
                //'email' => $userinfo->email, 
                'created_at' => $current_timestamp, 
                'updated_at' => $current_timestamp
            ]
        );
        return $saveHistory;
        //Log::info('=== TestEventListener  ========');
    }
}
