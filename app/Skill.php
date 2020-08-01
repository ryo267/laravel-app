<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    //
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_skill', 'skill_id', 'user_id');
    }
}
