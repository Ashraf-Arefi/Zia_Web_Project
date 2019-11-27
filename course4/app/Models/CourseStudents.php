<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStudents extends Model
{
    protected $table = "student_class";
    protected $primaryKey = "st_cl_id";
    protected $guarded =["st_cl_id"];
    protected $fillable =["student_id","class_id","c_discount","c_date","c_payment","c_borrow",'bill_number','class_name','status'];
    public $timestamps = false;

    public function student()
    {
        return $this->hasMany(Student::class,"student_id");
    }

    public function course()
    {
        return $this->hasMany(Course::class,"class_id");
    }
}
