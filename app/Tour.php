<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $table='tours';

    protected $fillable = ['tour_name','start_time','start_place','user_max','cover_photo','status',];

    public function link()
    {
    	return $this->hasMany('App\Link');
    }

}
