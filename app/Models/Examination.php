<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['animal_name', 'species', 'discovery_date', 'discovery_place', 'color', 'animal_age', 'animal_description', 'gender', 'photo_path'];
}
