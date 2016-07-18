<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table='links';

    protected $fillable = ['tour_id','user_id','type',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }
}
