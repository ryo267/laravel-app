<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function comments()
    {
        return $this->belongsToMany(Comment::class,'post_comment');
    }

    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getPostsCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }
}
