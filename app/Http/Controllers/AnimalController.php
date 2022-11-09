<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController{
    public function addPet(Request $request){

        $date = Carbon::parse($request->discoveryDate);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('name', $request->input('name'))
                ->with('species', $request->input('species'))
                ->with('color', $request->input('color'))
                ->with('age', $request->input('age'))
                ->with('discoveryPlace', $request->input('discoveryPlace'))
                ->with('description', $request->input('description'))
                ->with('message','Date is in the future');

        }else {
            $request['discoveryDate'] = $date->format('Y-m-d');
            $filename = NULL;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move(base_path('public\uploads\animal_images\\'), $filename);
            }

            $animal = Animal::create([
                'name' => $request->input('name'),
                'species' => $request->input('species'),
                'discovery_date' => $request->input('discoveryDate'),
                'discovery_place' => $request->input('discoveryPlace'),
                'color' => $request->input('color'),
                'age' => $request->input('age'),
                'description' => $request->input('description'),
                'gender' => $request->input('inlineRadioOptions'),
                'photo_path' => $filename,
            ]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Pet was successfully added');
        }
    }

    public function getAllPets() : array{
        $result = DB::select('SELECT * FROM animals ORDER BY animals.discovery_date DESC');
        return $result;
    }

    public function getPetDetail($id) : array{
        //$result = DB::table('animals')->where('animal_id', $id)->get();
        $result = DB::select('SELECT * FROM animals WHERE animals.animal_id LIKE :id', ['id' => $id->animal_id]);
        return $result;
    }

    public function showPetDetail(Request $request){
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }

    public function showPetEdit(Request $request){
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-edit', compact('result', 'result'));
    }

    public function editPet(Request $request){
        $date = Carbon::parse($request->discoveryDate);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('name', $request->input('name'))
                ->with('species', $request->input('species'))
                ->with('color', $request->input('color'))
                ->with('age', $request->input('age'))
                ->with('discoveryPlace', $request->input('discoveryPlace'))
                ->with('description', $request->input('description'))
                ->with('message','Date is in the future');

        }else {
            $request['discoveryDate'] = $date->format('Y-m-d');
            $filename = NULL;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move(base_path('public\uploads\animal_images\\'), $filename);
            }
            $affected = DB::table('animals')
                -> where('animal_id', $request->animal_id)
                -> update([
                    'name' => $request->input('name'),
                    'species' => $request->input('species'),
                    'color' => $request->input('color'),
                    'age' => $request->input('age'),
                    'discovery_place' => $request->input('discoveryPlace'),
                    'description' => $request->input('description'),
            ]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Pet was successfully edited');
        }
    }

}
