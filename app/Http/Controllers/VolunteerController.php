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
}
