<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PercentageSalaryPayment extends Model
{
    protected $table ="percentage_salary_payment";
    protected $primaryKey = "percentage_salary_payment_id";
    protected $guarded = "percentage_salary_payment_id";

    public $timestamps = false;
}
