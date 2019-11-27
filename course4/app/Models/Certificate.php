<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table='certificate';
    protected $guarded=['certificate_id'];
    protected $primaryKey='certificate_id';
    public $timestamps=false;
}
