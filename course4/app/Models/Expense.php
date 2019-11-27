<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table='expense';
    protected $primaryKey='expense_id';
    protected $guarded=['expense_id'];
    public $timestamps=false;
}
