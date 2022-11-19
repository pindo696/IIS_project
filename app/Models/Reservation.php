<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reservation extends Model{
    use HasFactory;
    public function db_getAllReservations(){
        return DB::select('SELECT * FROM reservations');
    }

    public function db_getAllReservationsJoinAnimalsJoinUsers(){
        $actual_date = Carbon::now();
        $result['upcomming'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            RIGHT JOIN users ON reservations.fk_volunteer_id = users.id
                            WHERE users.role LIKE 'volunteer'
                            AND reservations.approved LIKE '0'
                            AND reservations.reservation_id NOT LIKE 'null'
                            AND reservations.reservation_from > :date", ['date' => $actual_date]);
        $result['past'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            RIGHT JOIN users ON reservations.fk_volunteer_id = users.id
                            WHERE users.role LIKE 'volunteer'
                            AND reservations.reservation_id NOT LIKE 'null'
                            AND reservations.reservation_from <= :date
                            AND reservations.approved LIKE '0'
                            LIMIT 6", ['date' => $actual_date]);
        return $result;
    }

    public function db_declineWalk($id){
        DB::table('reservations')->where('reservation_id', $id)->delete();
    }

    public function db_acceptWalk($id){
        DB::table('reservations')->where('reservation_id', $id)->update(array('approved'=>'1'));
    }

    public function db_getPetReservations($id){
        $actual_date = Carbon::now();
        $result['past']= DB::select("SELECT reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            JOIN users ON users.id = reservations.fk_volunteer_id
                            WHERE reservations.reservation_from <= :date AND reservations.approved LIKE '1' AND fk_animal_id LIKE :id", ['date'=> $actual_date, 'id' => $id]);
        $result['upcomming']= DB::select("SELECT reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            JOIN users ON users.id = reservations.fk_volunteer_id
                            WHERE reservations.reservation_from >= :date AND fk_animal_id LIKE :id", ['date'=> $actual_date, 'id' => $id]);
        return $result;
    }

}
