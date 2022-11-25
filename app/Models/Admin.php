<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function db_updateUser(Request $request){
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $age = Carbon::parse($request->input('birth_date'))->age;
        $user = DB::table('users')
            -> where('id', $request->user_id)
            -> update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'birth_date' => $request->input('birth_date'),
                'age' => $age,
                'phone' => $request->input('phone'),
                'role' => $request->input('role'),
                'confirmation' => $request->input('confirmation'),
                'updated_at' => $current_date_time,
            ]);

    }

    public function db_updateAnimal(Request $request){
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $animal = DB::table('animals')
            -> where('animal_id', $request->animal_id)
            -> update([
                'animal_name' => $request->input('animal_name'),
                'species' => $request->input('species'),
                'color' => $request->input('color'),
                'animal_age' => $request->input('animal_age'),
                'gender' => $request->input('gender'),
                'animal_description' => $request->input('animal_description'),
                'discovery_place' => $request->input('discovery_place'),
                'discovery_date' => $request->input('discovery_date'),
                'updated_at' => $current_date_time,
            ]);

    }

    public function db_createUser(Request $request){
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $age = Carbon::parse($request->input('birth_date'))->age;
        $examination = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'birth_date' => $request->input('birth_date'),
            'age' => $age,
            'phone' => $request->input('phone'),
            'role' => $request->input('role'),
            'confirmation' => $request->input('confirmation'),
            'updated_at' => $current_date_time,
            'created_at' => $current_date_time,
            'password' => Hash::make($request->input('password')),
        ]);
    }

}
