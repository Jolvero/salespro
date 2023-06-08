<?php

namespace App\Listeners;

use App\Events\NuevoProspecto;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistroProspecto implements ShouldQueue
{

    public $connection = 'database';
    public $queue = 'listeners';

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
     * @param  NuevoProspecto  $event
     * @return void
     */
    public function handle(NuevoProspecto $event)
    {
        //
        dd('se registro el prospecto'. ' '.$event->id);
    }
}
