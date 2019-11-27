<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table ="student_score";
    protected $primaryKey = "score_id";
    protected $guarded = "score_id";

    public $timestamps = false;
}
