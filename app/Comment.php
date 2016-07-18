<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table='comments';

    protected $fillable = ['tour_id','user_id','photo','text','comment_id',];
}
