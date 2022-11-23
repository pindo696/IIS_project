<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Andrej Luptak (xlupta05)
     * Controller implements volunteer part
     * Implements methods for volunteer
     */

    /**
     * index view for volunteer
     * @return view for volunteer reservations history
     */
    public function index(){
        $userID = auth()->user()->id;
        $result = app()->call('App\Models\Volunteer@db_getVolunteerHistory', ['id' => $userID]);
        return view('volunteer-history', compact('result', 'result'));
        //return view('volunteer');
    }
    public function unauth(){
        return view('unauth');
    }
    public function support(){
        return view('support');
    }

    /**
     * Method used to get data from Model part
     * Gets data about volunteer history based on volunteer id
     * @param Request $request
     * @return - volunteer history view
     */
    public function getVolunteerHistory(Request $request){
        $userID = auth()->user()->id;
        $result = app()->call('App\Models\Volunteer@db_getVolunteerHistory', ['id' => $userID]);
        return view('volunteer-history', compact('result', 'result'));
    }

    /**
     * gets pet detail view
     * uses animal controller method to obtain DB data
     * @param Request $request
     * @return - pet detail view
     */
    public function petDetail(Request $request){
        if(!$request->isMethod('post')) return redirect('/volunteer');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }

    /**
     * creates request to pet schedule based on pet id form Model part
     * @param Request $request
     * @return - pet schedule view
     */
    public function petSchedule(Request $request){
        if(!$request->isMethod('post')) return redirect('/volunteer');
        $result = app()->call('App\Models\Volunteer@db_getPetScheduleByVolunteerIDAndAnimalID', ['animal_id' => $request->animal_id, 'volunteer_id' => $request->volunteer_id]);
        return view('pet-schedule', compact('result', 'result'));
    }

    /**
     * creates request to pet schedule based on pet id form Model part
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPetSchedule(Request $request){
        $result = app()->call('App\Models\Volunteer@db_getPetScheduleByVolunteerIDAndAnimalID', ['animal_id' => $request->animal_id, 'volunteer_id' => $request->volunteer_id]);
        return view('pet-schedule', compact('result', 'result'));
    }

    /**
     * Method used by volunteer for book listed termin
     * Books termin, then loads updated data for animal scheudle
     * @param Request $request
     * @return - back to pet schedule view
     */
    public function bookTermin(Request $request){
        $ret_val = app()->call('App\Models\Volunteer@db_bookTermin', ['reservation_id' => $request->reservation_id, 'volunteer_id' => $request->volunteer_id]);
        $result = app()->call('App\Models\Volunteer@db_getPetScheduleByVolunteerIDAndAnimalID', ['animal_id' => $request->animal_id, 'volunteer_id' => $request->volunteer_id]);
        return view('pet-schedule', compact('result', 'result'))->with('success', 'Termin booked');
    }

    /**
     * Method used to cancel allready booked termin
     * Cancel termin, then loads updated data to display updated animal schedule
     * @param Request $request
     * @return - back to pet schedule
     */
    public function cancelTermin(Request $request){
        $ret_val = app()->call('App\Models\Volunteer@db_releaseTermin', ['reservation_id' => $request->reservation_id]);
        $result = app()->call('App\Models\Volunteer@db_getPetScheduleByVolunteerIDAndAnimalID', ['animal_id' => $request->animal_id, 'volunteer_id' => $request->volunteer_id]);
        return view('pet-schedule', compact('result', 'result'))->with('success', 'Termin booked');

    }

}
