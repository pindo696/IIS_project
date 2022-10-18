<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Careman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaremanController extends Controller{
    function index(){
        $result = DB::table('users') -> where('role', 'like', 'volunteer') -> orderByDesc('confirmation')
            ->get();
        return view('careman', compact('result', 'result'));
    }

    function pets(){
        $result = app()->call('App\Http\Controllers\AnimalController@getAllPets');
        return view('pets', compact('result', 'result'));
    }

    function addpet(){
        return view('addpet');
    }

    public function acceptVolunteer(Request $request){
        DB::table('users')->where('id', $request->data_id)->update(array('confirmation'=>'accepted'));
        return redirect('/careman/requests');
    }

    public function declineVolunteer(Request $request){
        DB::table('users')->where('id', $request->data_id)->update(array('confirmation'=>'declined'));
        return redirect('/careman/requests');
    }
    public function banVolunteer(Request $request){
        DB::table('users')->where('id', $request->data_id)->update(array('confirmation'=>'banned'));
        return redirect('/careman/requests');
    }
    public function deleteVolunteer(Request $request){
        DB::table('users')->delete($request->data_id);
        return redirect('/careman/requests');
    }

    public function update(Request $request, $id){

    }

    public function edit($id){
        dd($id);
    }

    public function showPetDetail(Request $request){
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }
}
