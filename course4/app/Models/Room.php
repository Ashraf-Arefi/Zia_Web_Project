<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table='room';
    protected $guarded=['room_id'];
    protected $primaryKey='room_id';
    public $timestamps=false;
}
