<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'post_id', 'user_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function post()
    {
        return $this->belongsTo(Post::class);
    }
}
