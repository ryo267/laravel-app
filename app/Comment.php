<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    //
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsToMany(User::class,'user_comment');
    }

    public function company()
    {
        return $this->belongsToMany(Company::class,'company_comment');
    }

    public function post()
    {
        return $this->belongsToMany(Post::class,'post_comment');
    }
    
    public function thanks()
    {
        return $this->hasMany(Thank::class);
    }
}
