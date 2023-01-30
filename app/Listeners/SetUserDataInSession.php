<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetUserDataInSession
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
    public function handle($event)
    {
        session([
            'user_id' => $event->user->id,
            'user_name' => $event->user->name,
            'parish_id' => $event->user->parish_id,
            'community_id' => $event->user->community_id,
            'role' => $event->user->roles->first()->name,
            'permissions' => $event->user->roles->first()->permissions->pluck('name'),
        ]);
    }
}
