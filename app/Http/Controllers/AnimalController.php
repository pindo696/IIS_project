<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnimalController{
    public function addPet(Request $request){

        $date = Carbon::parse($request->discoveryDate);
        if($date->isPast()){
            dd('Date is in the future');
        }
        $request['discoveryDate'] = $date->format('Y-m-d');

        $animal = Animal::create([
            'name' => $request->input('name'),
            'species' => $request->input('species'),
            'discovery_date' => $request->input('discoveryDate'),
            'discovery_place' => $request->input('discoveryPlace'),
            'color' => $request->input('color'),
            'age' => $request->input('age'),
            'description' => $request->input('description'),
            'gender' => $request->input('inlineRadioOptions'),

        ]);
        return redirect("/careman/animals");
    }
}
