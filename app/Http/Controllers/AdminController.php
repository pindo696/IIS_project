<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Validator;

class AdminController{
    public function index(){
        return view('admin', ['users' => User::latest()->filter(request(['searchUser']))->get()]);
    }

    public function show_animals() {
        return view('adminanimals', ['animals' => Animal::latest()->filter(request(['search']))->get()]);
    }

    public function remove_user(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        app()->call('App\Models\Admin@db_removeUser', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully removed user!')
            ->with('success', true)
            ->with('message','User successfully removed!');
    }
    public function remove_animal(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin/animals');
        app()->call('App\Models\Admin@db_removeAnimal', ['request' => $request]);
        return redirect("/admin/animals")->with('success', true)->with('message', 'Successfully removed animal!')
            ->with('success', true)
            ->with('message','Animal successfully removed!');
    }

    public function manage_user(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        $date = Carbon::parse($request->birth_date);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('message','Birth date is in the future!');
        }else {
            $validate = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'regex: ^[a-z0-9]+@[a-z0-9]+.[[a-z]+^'],
                'phone' => ['required', 'min:9', 'max:14', 'regex: ^(\+421|00421|0)[9][0-9]{8}|(\+420|00420|0)[4-7][0-9]{8}^'],
            ],[]);
            if($validate->fails()){
                return redirect()->back()->with('error', true)->with('message','Unable to edit user. Invalid data format!');
            }
            $validate = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'regex: ^[a-z0-9]+@[a-z0-9]+.[[a-z]+^', 'unique:users'],
            ],[]);
            if($validate->fails()){
                //return redirect()->back()->with('error', true)->with('message','Unable to edit user. Email address already in use!');
            }
            app()->call('App\Models\Admin@db_updateUser', ['request' => $request]);
            return redirect("/admin")->with('success', true)->with('message', 'Successfully updated user: ' . $request->name . '!')
                ->with('success', true)
                ->with('message','User successfully edited!');
        }
    }
    public function manage_animal(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin/animals');
        $date = Carbon::parse($request->discovery_date);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('message','Discovery date is in the future!');
        }else{
            $validate = Validator::make($request->all(), [
                'animal_age' => ['required', 'int', 'min:0', 'max:150', 'regex: ^[0-9]+^'],
            ],[]);
            if($validate->fails()){
                return redirect()->back()->with('error', true)->with('message','Unable to edit animal. Invalid age!');
            }
            app()->call('App\Models\Admin@db_updateAnimal', ['request' => $request]);
            return redirect("/admin/animals")->with('success', true)->with('message', 'Successfully updated animal: ' . $request->animal_name . '!')
                ->with('success', true)
                ->with('message','Animal successfully edited!');
        }
    }
    public function create_user(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        $date = Carbon::parse($request->birth_date);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('name', $request->input('name'))
                ->with('surname', $request->input('surname'))
                ->with('birth_date', $request->input('birth_date'))
                ->with('phone', $request->input('phone'))
                ->with('role', $request->input('role'))
                ->with('email', $request->input('email'))
                ->with('confirmation', $request->input('confirmation'))
                ->with('password', $request->input('password'))
                ->with('message','Birth date is in the future!');
        }else {
            $validate = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'regex: ^[a-z0-9]+@[a-z0-9]+.[[a-z]+^'],
                'phone' => ['required', 'min:9', 'max:14', 'regex: ^(\+421|00421|0)[9][0-9]{8}|(\+420|00420|0)[4-7][0-9]{8}^'],
            ],[]);
            if($validate->fails()){
                return redirect()->back()->with('error', true)->with('message','Unable to create user. Invalid data format!');
            }
            $validate = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'regex: ^[a-z0-9]+@[a-z0-9]+.[[a-z]+^', 'unique:users'],
            ],[]);
            if($validate->fails()){
                return redirect()->back()->with('error', true)->with('message','Unable to create user. Email address already in use!');
            }
            app()->call('App\Models\Admin@db_createUser', ['request' => $request]);
            return redirect()->back()
                ->with('success', true)
                ->with('message', 'Successfully created a new user!');
        }
    }

    public function create_animal(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        $date = Carbon::parse($request->discoveryDate);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('message','Discovery date is in the future!');
        }else {
            $validate = Validator::make($request->all(), [
                'age' => ['required', 'int', 'min:0', 'max:150', 'regex: ^[0-9]+^'],
            ],[]);
            if($validate->fails()) {
                return redirect()->back()->with('error', true)->with('message', 'Unable to add animal. Invalid age!');
            }
            app()->call('App\Models\Animal@db_addPet', ['request' => $request]);
            return redirect()->back()
                ->with('success', true)
                ->with('message', 'Successfully created a new animal!');
        }
    }
}

