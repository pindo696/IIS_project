<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reservation extends Model{
    use HasFactory;

    protected $fillable = ['fk_animal_id', 'reservation_from', 'reservation_to', 'timestamp'];

    public function db_getAllReservations(){
        return DB::select('SELECT * FROM reservations');
    }

    public function db_getAllReservationsJoinAnimalsJoinUsers(){
        $actual_date = Carbon::now();
        // shows upcomming REQUESTED pet schedules
        $result['upcomming'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            LEFT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            LEFT JOIN users ON reservations.fk_taken_by_volunteer_id = users.id
                            WHERE reservations.reservation_status LIKE 'requested'
                            AND reservations.reservation_from > :date ORDER BY reservation_from DESC", ['date' => $actual_date]);
        //dd($actual_date, $result);
        //dd($result['upcomming'][0]->reservation_from > $actual_date);
        // shows past NOT REQUESTED pet schedules

        $result['past'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            LEFT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            LEFT JOIN users ON reservations.fk_taken_by_volunteer_id = users.id
                            WHERE reservations.reservation_from <= :date
                            AND reservations.reservation_status LIKE 'listed'
                            LIMIT 6", ['date' => $actual_date]);
        return $result;
    }

    public function db_declineWalk($userID, $id){
        DB::table('reservations')->where('reservation_id', $id)->update(array('reservation_status'=>'declined'));
        DB::table('reservations')->where('reservation_id', $id)->update(array('fk_approved_by_id' => $userID));
    }

    public function db_acceptWalk($userID, $id){
        DB::table('reservations')->where('reservation_id', $id)->update(array('reservation_status'=>'approved'));
        DB::table('reservations')->where('reservation_id', $id)->update(array('fk_approved_by_id' => $userID));
    }

    public function db_getPetReservations($id){
        $actual_date = Carbon::now();
        $result['past']= DB::select("SELECT reservations.reservation_id, reservations.reservation_status, reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            LEFT JOIN users ON users.id = reservations.fk_taken_by_volunteer_id
                            WHERE reservations.reservation_from <= :date AND fk_animal_id LIKE :id", ['date'=> $actual_date, 'id' => $id]);
        $result['upcomming']= DB::select("SELECT reservations.reservation_id, reservations.reservation_status, reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            LEFT JOIN users ON users.id = reservations.fk_taken_by_volunteer_id
                            WHERE reservations.reservation_from >= :date AND fk_animal_id LIKE :id", ['date'=> $actual_date, 'id' => $id]);
        $result['animal'] = $id;
        return $result;
    }

}
