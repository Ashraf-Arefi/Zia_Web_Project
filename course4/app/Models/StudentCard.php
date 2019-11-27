<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCard extends Model
{
    protected $table ="student_card";
    protected $primaryKey = "student_card_id";
    protected $guarded = "student_card_id";

    public $timestamps = false;
}
