<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaremanController extends Controller{
    function index(){
        $result = DB::table('users')
            ->get();
        return view('careman', compact('result', 'result'));
    }
}
