<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(){
        return view('volunteer');
    }
    public function unauth(){
        return view('unauth');
    }
    public function support(){
        return view('support');
    }

    public function getVolunteerHistory(Request $request){
        $userID = auth()->user()->id;
        $result = app()->call('App\Models\Volunteer@db_getVolunteerHistory', ['id' => $userID]);
        return view('volunteer-history', compact('result', 'result'));
    }

    public function petDetail(Request $request){
        if(!$request->isMethod('post')) return redirect('/volunteer');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }

    public function petSchedule(Request $request){
        if(!$request->isMethod('post')) return redirect('/volunteer');
        $result = app()->call('App\Models\Reservation@db_getPetReservations', ['id' => $request->animal_id]);
        return view('pet-schedule', compact('result', 'result'));
    }

}
