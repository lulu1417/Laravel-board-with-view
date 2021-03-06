<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'post_id', 'user_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function post()
    {
        return $this->belongsTo(Post::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
