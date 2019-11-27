<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookStudent extends Model
{
    protected $table = "student_book";
    protected $primaryKey = "st_bk_id";
    protected $guarded = ['st_bk_id'];
    public $timestamps = false;
}
