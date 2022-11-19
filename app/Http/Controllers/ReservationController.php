<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller{
    public function getAllReservations(){
        return app()->call('App\Models\Reservation@db_getAllReservationsJoinAnimalsJoinUsers');
    }
}
