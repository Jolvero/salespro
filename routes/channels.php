<?php

use App\Prospecto;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('nuevo-prospecto', function ($user, Prospecto $prospecto) {
    return $user->id === $prospecto->user_id;
});


