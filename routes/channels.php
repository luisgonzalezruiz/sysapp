<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('product', function () {
    return true;
});


//esto debe coincidir con el channel creado en el evento NewTicket
//el id(corresponde al usuario a quien se le asigno el ticket)
//el $user(es el usuario actualmente autenticado) y debe coindicidir con el usuario asignado para que
//pueda escuchar el evento
//Broadcast::channel('ticket.{id}', function ($user, $id) {
//    // este user es el logueado, el $id seria el user_id que asignamos en el ticket
//   return $user->id === (int) $id;
//});
