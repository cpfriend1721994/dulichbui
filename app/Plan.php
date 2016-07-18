<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table='plans';

    protected $fillable = ['tour_id','arrival_place','arrival_time','stay_place','stay_period','activities','cover_photo','planto_id','vehicle','period',];
}
