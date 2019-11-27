<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table ="library";
    protected $primaryKey = "book_library_id";
    protected $guarded = "book_library_id";

    public $timestamps = false;
}
