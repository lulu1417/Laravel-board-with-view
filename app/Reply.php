<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'comment_id', 'user_id', 'content'
    ];
    protected $hidden = [
        'updated_at'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
    function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
