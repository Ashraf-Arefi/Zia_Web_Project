<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table ="class";
    protected $primaryKey = "class_id";
    protected $guarded = "class_id";
    protected $fillable = ["subject_id","employee_id","room_name",'start_time','end_time',"start_date","fees","class_name","certificate","class_status","status"];
    public $timestamps = false;
    public function student()
    {
        return $this->belongsToMany(Student::class,'student_class','student_id','class_id');
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class,"subject_id");
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,"employee_id");
    }

    public function room()
    {
        return $this->belongsTo(Room::class,"room_id");
    }


}
