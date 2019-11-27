<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    protected $table='class_teacher';
    protected $guarded=['class_teacher_id'];
    protected $primaryKey='class_teacher_id';
    public $timestamps=false;
}
