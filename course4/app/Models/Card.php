<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table='card';
    protected $guarded=['card_id'];
    protected $primaryKey='card_id';
    public $timestamps=false;
}
