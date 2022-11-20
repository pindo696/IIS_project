<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Medical_Records extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_id', 'fk_animal_id', 'fk_user_id', 'record_type', 'medical_description', 'medical_date'];


    public function db_getAnimalRecordDetailed($id){
        $records = DB::select("SELECT * FROM medical_records JOIN animals ON medical_records.fk_animal_id=animals.animal_id JOIN users ON medical_records.fk_user_id=users.id WHERE fk_animal_id=$id");
        return [
            'records' => $records
        ];
    }

}