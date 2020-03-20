<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'comment_id', 'user_id', 'content'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
}
