<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Careman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaremanController extends Controller{

    /**
     * Andrej Luptak (xlupta05)
     * Controller implements actions associated with careman
     * Implements all careman actions
     */

    /**
     * call Model part to get data about volunteers and animal reservations
     * @return - index view of caream
     */
    function index(){
        $result['volunteers'] = app()->call('App\Models\Careman@getVolunteers');
        $result['reservations'] = app()->call('App\Http\Controllers\ReservationController@getAllReservations');
        return view('careman', ['result' => $result]);
    }

    /**
     * displays all pets
     * @return - view of all pets
     */
    function pets(){
        $result = app()->call('App\Http\Controllers\AnimalController@getAllPets');
        return view('pets', compact('result', 'result'));
    }

    /**
     * redirect to formular, where animal can be added
     * @return - formular for adding pet
     */
    function addpet(){
        return view('addpet');
    }

    /**
     * method used for accepting volunteers
     * method calls Model part to change volunteer status in DB
     * @param Request $request
     * @return - back to view of all requests
     */
    public function acceptVolunteer(Request $request){
        app()->call('App\Models\Careman@acceptVolunteer');
        return redirect('/careman/requests');
    }

    /**
     * method used for declining volunteers
     * method calls Model part to change volunteer status in DB
     * @param Request $request
     * @return - back to view of all requests
     */
    public function declineVolunteer(Request $request){
        app()->call('App\Models\Careman@declineVolunteer');
        return redirect('/careman/requests');
    }

    /**
     * method used for banning volunteers
     * method calls Model part to change volunteer status in DB
     * @param Request $request
     * @return - back to view of all requests
     */
    public function banVolunteer(Request $request){
        app()->call('App\Models\Careman@banVolunteer');
        return redirect('/careman/requests');
    }

    /**
     * method used for deleting volunteers
     * method calls Model part to change volunteer status in DB
     * modal call permanently deletes volunteer from DB
     * @param Request $request
     * @return - back to view of all requests
     */
    public function deleteVolunteer(Request $request){
        app()->call('App\Models\Careman@deleteVolunteer');
        return redirect('/careman/requests');
    }

    /**
     * debug function for parsing arguments
     * @param $id parsed id
     * @return void
     */
    public function edit($id){
        dd($id);
    }

}
