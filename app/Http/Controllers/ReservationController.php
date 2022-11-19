<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller{
    public function getAllReservations(){
        return app()->call('App\Models\Reservation@db_getAllReservationsJoinAnimalsJoinUsers');
    }

    public function declineWalk(Request $request){
       app()->call('App\Models\Reservation@db_declineWalk', ['id' => $request->request_id]);
       return redirect('/careman/requests');
    }

    public function acceptWalk(Request $request){
        app()->call('App\Models\Reservation@db_acceptWalk', ['id' => $request->request_id]);
        return redirect('/careman/requests');
    }
}
