<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller{
    public function getAllReservations(){
        return app()->call('App\Models\Reservation@db_getAllReservationsJoinAnimalsJoinUsers');
    }

    public function declineWalk(Request $request){
       $userID = auth()->user()->id;
       app()->call('App\Models\Reservation@db_declineWalk', ['userID' => $userID, 'id' => $request->request_id]);
       return redirect('/careman/requests');
    }

    public function acceptWalk(Request $request){
        $userID = auth()->user()->id;
        app()->call('App\Models\Reservation@db_acceptWalk', ['userID' => $userID, 'id' => $request->request_id]);
        return redirect('/careman/requests');
    }

    public function db_getPetReservations($id){
        $result = DB::select("SELECT * FROM reservations WHERE fk_animal_id LIKE :id", ['id' => $id]);
        return $result;
    }
}
