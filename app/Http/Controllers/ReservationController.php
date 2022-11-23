<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller{

    /**
     * Andrej Luptak (xlupta05)
     * Controller implements actions associated with reservations
     * Implements methods for maintaining reservations
     */

    /**
     * calls Model part to get all reservations
     * @return DB result, possibly array of results
     */
    public function getAllReservations(){
        return app()->call('App\Models\Reservation@db_getAllReservationsJoinAnimalsJoinUsers');
    }

    /**
     * Use to decline requested walk
     * @param Request $request
     * @return - requests view
     */
    public function declineWalk(Request $request){
       $userID = auth()->user()->id;
       app()->call('App\Models\Reservation@db_declineWalk', ['userID' => $userID, 'id' => $request->request_id]);
       return redirect('/careman/requests');
    }

    /**
     * Use to accept requested walk
     * @param Request $request
     * @return - requests view
     */
    public function acceptWalk(Request $request){
        $userID = auth()->user()->id;
        app()->call('App\Models\Reservation@db_acceptWalk', ['userID' => $userID, 'id' => $request->request_id]);
        return redirect('/careman/requests');
    }

    /**
     * Get all animal reservation, based on animaml id
     * @param $id of animal
     * @return array of DB results
     */
    public function db_getPetReservations($id){
        $result = DB::select("SELECT * FROM reservations WHERE fk_animal_id LIKE :id", ['id' => $id]);
        return $result;
    }

    /**
     * Prepare for creating single item in schedule
     * @param Request $request
     * @return - formular for creating schedule item
     */
    public function showCreateScheduleItemForm(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = $request->animal_id;
        return view('create-schedule-item', compact('result', 'result'));
    }

    /**
     * Method called on create schedule item formular send
     * Parses and prepares data from formular for Model part
     * @param Request $request
     * @return - on error animal page with error message
     *         - on success returns to animal view with success message
     */
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
        if($date_from > $date_to){
            return redirect("/careman/animals")
                ->with('error', true)
                ->with('message', 'Invalid dates. Dates may be flipped.');
        }
        $format = strtotime($date_from);
        $start_date = date('Y-m-d', $format);
        $start_time = date('H:m:s', $format);
        $format = strtotime($date_to);
        $end_date = date('Y-m-d', $format);
        $end_time = date('H:m:s', $format);

        $start_time = $request->input('timeFrom');
        $end_time = $request->input('timeTo');

        $start = $start_date . ' ' . $start_time . ':00';
        $end = $end_date . ' ' . $end_time . ':00';

        $return_val = app()->call('App\Models\Reservation@db_createReservationItem', ['animal_id' => $animal_id, 'start' => $start, 'end'=>$end]);
        if($return_val){
            return redirect("/careman/animals")->with('success', true)->with('message', 'Schedule item for pet was created');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Unable to create schedule item');
        }
    }

    /**
     * Deletes walk from listed or booked schedule item
     * @param Request $request
     * @return - animal page with corresponding message
     */
    public function deleteWalk(Request $request){
        $return_val = app()->call('App\Models\Reservation@db_deleteWalk', ['reservation_id' => $request->reservation_id]);
        if($return_val){
            return redirect("/careman/animals")->with('success', true)->with('message', 'Schedule item succesfully deleted from list');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Unable to delete schedule item');
        }
    }

}
