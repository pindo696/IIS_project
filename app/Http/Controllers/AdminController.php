<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController{
    public function index(Request $request){
        return view('admin', ['users' => User::latest()->get(), 'animals' => Animal::latest()->get()]);
    }
}
