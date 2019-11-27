<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table='subject';
    protected $guarded=['subject_id'];
    protected $primaryKey= 'subject_id';
    public $timestamps=false;

}
