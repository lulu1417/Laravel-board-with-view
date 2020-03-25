<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'post_id', 'user_id', 'content'
    ];

    protected $hidden = [
        'updated_at'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }

    function post()
    {
        return $this->belongsTo(Post::class);
    }

    function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
