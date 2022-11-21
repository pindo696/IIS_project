<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['animal_name', 'species', 'discovery_date', 'discovery_place', 'color', 'animal_age', 'animal_description', 'gender', 'photo_path'];
    public static function getbyid($id){
        return  DB::select('SELECT * FROM animals WHERE animal_id LIKE :id', ['id' => $id]);
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('animal_name', 'like', '%' . request('search') . '%')
                  ->orWhere('species', 'like', '%' . request('search') . '%')
                  ->orWhere('gender', 'like', '%' . request('search') . '%')
                  ->orWhere('animal_age', 'like', '%' . request('search') . '%')
                  ->orWhere('color', 'like', '%' . request('search') . '%')
                  ->orWhere('discovery_place', 'like', '%' . request('search') . '%');
        }
    }

    public function db_addPet($request){
        $file = NULL;
        if($request->hasFile('image')){
            //uklada do storage/app/public s unikatnym pregenerovanym nazvom
            $file = $request->file('image')->store('animal_images', 'public');
        }

        $animal = Animal::create([
            'animal_name' => $request->input('name'),
            'species' => $request->input('species'),
            'discovery_date' => $request->input('discoveryDate'),
            'discovery_place' => $request->input('discoveryPlace'),
            'color' => $request->input('color'),
            'animal_age' => $request->input('age'),
            'animal_description' => $request->input('description'),
            'gender' => $request->input('inlineRadioOptions'),
            'photo_path' => $file,
        ]);
    }

    public function db_editPet($request, $date){
        $request['discoveryDate'] = $date->format('Y-m-d');
        $file = NULL;
        if($request->hasFile('image')){
            $file = $request->file('image')->store('animal_images', 'public');
        }else{
            $file = DB::table('animals')
                ->select('photo_path')
                ->where('animal_id', $request->animal_id)
                ->get();
            $file = $file[0]->photo_path;
        }
        $affected = DB::table('animals')
            -> where('animal_id', $request->animal_id)
            -> update([
                'animal_name' => $request->input('name'),
                'species' => $request->input('species'),
                'color' => $request->input('color'),
                'animal_age' => $request->input('age'),
                'discovery_date' => $request->input('discoveryDate'),
                'discovery_place' => $request->input('discoveryPlace'),
                'animal_description' => $request->input('description'),
                'photo_path' => $file,
            ]);
    }

    public function db_deletePet(\Illuminate\Http\Request $request){
        $n_rows = DB::table('animals')
            -> where('animal_id', 'like', $request->animal_id)
            -> delete();
        return $n_rows;
    }

    public function db_getPetExaminations($id) : array{
        $result = DB::select('SELECT * FROM examinations
                    RIGHT JOIN animals ON animals.animal_id = examinations.fk_animal_id
                    LEFT JOIN users ON examinations.fk_vet_id = users.id
                    WHERE animals.animal_id LIKE :id ORDER BY examinations.examination_from DESC', ['id' => $id]);
        return $result;
    }

    public function db_getAllPets() : array{
        return DB::select('SELECT * FROM animals ORDER BY animals.discovery_date DESC');;
    }

    public function db_getPetDetail($id) : array{
        return  DB::select('SELECT * FROM animals LEFT JOIN examinations ON animals.animal_id = examinations.fk_animal_id WHERE animals.animal_id LIKE :id', ['id' => $id->animal_id]);
    }

}
