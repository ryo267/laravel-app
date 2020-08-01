<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thank extends Model
{
    //
    public $timestamps = false;

    protected $guarded = ['id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
