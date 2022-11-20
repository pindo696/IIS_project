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

}
