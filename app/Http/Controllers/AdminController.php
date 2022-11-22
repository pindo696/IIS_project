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

    public function remove_user(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        app()->call('App\Models\Admin@db_removeUser', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully removed user!');
    }
    public function remove_animal(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        app()->call('App\Models\Admin@db_removeAnimal', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully removed animal!');
    }

    public function manage_user(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        app()->call('App\Models\Admin@db_updateUser', ['request' => $request]);
        return redirect("/admin")->with('success', true)->with('message', 'Successfully updated user: ' . $request->name . '!');
    }
    public function manage_animal(Request $request){
        if(!$request->isMethod('put')) return redirect('/admin');
        app()->call('App\Models\Admin@db_updateAnimal', ['request' => $request]);
        return redirect("/admin")->with('success', true)->with('message', 'Successfully updated animal: ' . $request->animal_name . '!');
    }
}

