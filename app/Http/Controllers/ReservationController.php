<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function showCreateScheduleItemForm(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = $request->animal_id;
        return view('create-schedule-item', compact('result', 'result'));
    }

    public function crateScheduleItem(Request $request){
        $animal_id = $request->input('animal_id');
        $date_from = $request->input('dateFrom');
        $date_to = $request->input('dateTo');
        if($date_from == null || $date_to == null){
            return redirect("/careman/animals")
                ->with('error', true)
                ->with('message', 'Date(s) not provided');
        }
        $date_from = Carbon::parse($request->dateFrom);
        $date_to = Carbon::parse($request->dateTo);
        if((($date_from->isPast()) ||($date_to->isPast()))){
            return redirect("/careman/animals")
                ->with('error', true)
                ->with('message', 'Date(s) in past');
        }
        if($date_from >= $date_to){
            return redirect("/careman/animals")
                ->with('error', true)
                ->with('message', 'Invalid dates. Dates may be flipped.');
        }
//        $format = Carbon::createFromFormat('Y-m-d H:i:s', $date_from);
//        $start_date = Carbon::createFromDate()
//        $start_time =
//        $end_date =
//        $end_time =
        dd($animal_id, $date_from, $date_to);
    }

}
