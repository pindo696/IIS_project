<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Volunteer extends Model
{
    use HasFactory;

    public function db_getVolunteerHistory($id){
        $actual_date = Carbon::now();
        $result['upcomming'] = DB::select("SELECT * FROM reservations
                    RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                    WHERE reservations.fk_taken_by_volunteer_id LIKE :id
                    AND reservations.reservation_status NOT LIKE 'listed'
                    AND reservations.reservation_from > :date", ['id' => $id, 'date'=>$actual_date]);
        $result['past'] = DB::select("SELECT * FROM reservations
                    RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                    WHERE reservations.fk_taken_by_volunteer_id LIKE :id
                    AND reservations.reservation_status NOT LIKE 'listed'
                    AND reservations.reservation_from <= :date", ['id' => $id, 'date'=>$actual_date]);
        return $result;
    }

}
