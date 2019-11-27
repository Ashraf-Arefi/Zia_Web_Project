<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table='department';
    protected $guarded=['department_id'];
    protected $primaryKey='department_id';
    public $timestamps=false;
    
}