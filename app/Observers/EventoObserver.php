<?php

namespace App\Observers;

use Auth;
use App\Evento;

class EventoObserver
{
    public function creating(Evento $evento){
        $evento->user_id = Auth::id();
    }
}
