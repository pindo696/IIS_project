<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['fk_animal_id', 'fk_requested_by_careman_id', 'fk_vet_id', 'examination_status', 'examination_type', 'examination_description', 'examination_from', 'examination_to'];
}
