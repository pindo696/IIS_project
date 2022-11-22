<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    use HasFactory;

    public function db_removeAnimal(Request $request){
        $animal = DB::table('animals')
            -> where('animal_id', $request->id)
            -> delete();
    }

    public function db_removeUser(Request $request){
        $animal = DB::table('users')
            -> where('id', $request->id)
            -> delete();
    }
    

}
