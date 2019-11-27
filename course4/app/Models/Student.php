<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table ="student";
    protected $primaryKey = "st_id";
    protected $guarded = "st_id";
    protected $fillable = [ 'first_name', 'last_name', 'father_name', 'gender', 'age', 'phone', 'address','date', 'photo', 'agreement_paper', 'status'];
    public $timestamps = false;



    public function course()
    {
        return $this->belongsToMany(Course::class,'student_class','student_id','class_id');
    }


}
