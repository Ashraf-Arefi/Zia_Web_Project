<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table ="book";
    protected $primaryKey = "book_id";
    protected $guarded = "book_id";
    protected $fillable = ["book_name","book_edition","department_id","book_price",'status'];
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
