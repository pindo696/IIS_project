<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model{
    use HasFactory;
    public function db_getAllReservations(){
        return DB::select('SELECT * FROM reservations');
    }

    public function db_getAllReservationsJoinAnimalsJoinUsers(){
        $result = DB::select("SELECT reservations.reservation_from, reservations.reservation_to, animals.animal_name, users.name
                            FROM reservations
                            RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            RIGHT JOIN users ON reservations.fk_volunteer_id = users.id WHERE users.role LIKE 'volunteer' AND reservations.reservation_id NOT LIKE 'null'");
        return $result;
    }

}
