<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    // https://laravel.com/docs/9.x/queries
    /**
     * test controller used to learn with Laravell
     * @return void
     */
    function getName(){
        DB::table('people')->select('name')->where('stefan' and 'peder')->get();
    }
}
