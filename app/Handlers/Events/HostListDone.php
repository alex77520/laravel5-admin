<?php

namespace App\Handlers\Events;

use App\Events\HostListSet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HostListDone
{
    /**
     * Create the event handler.
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
     * @param  HostListSet  $event
     * @return void
     */
    public function handle(HostListSet $event)
    {
        //
        dump('aaaaaa');
    }
}
