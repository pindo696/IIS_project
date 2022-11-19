<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Careman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaremanController extends Controller{
    function index(){
        $result['volunteers'] = app()->call('App\Models\Careman@getVolunteers');
        $result['reservations'] = app()->call('App\Http\Controllers\ReservationController@getAllReservations');
        return view('careman', ['result' => $result]);
    }

    function pets(){
        $result = app()->call('App\Http\Controllers\AnimalController@getAllPets');
        return view('pets', compact('result', 'result'));
    }

    function addpet(){
        return view('addpet');
    }

    public function acceptVolunteer(Request $request){
        app()->call('App\Models\Careman@acceptVolunteer');
        return redirect('/careman/requests');
    }

    public function declineVolunteer(Request $request){
        app()->call('App\Models\Careman@declineVolunteer');
        return redirect('/careman/requests');
    }
    public function banVolunteer(Request $request){
        app()->call('App\Models\Careman@banVolunteer');
        return redirect('/careman/requests');
    }
    public function deleteVolunteer(Request $request){
        app()->call('App\Models\Careman@deleteVolunteer');
        return redirect('/careman/requests');
    }

    public function edit($id){
        dd($id);
    }

}
