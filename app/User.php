<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'screen_name',
        'name',
        'profile_text',
        'profile_image',
        'back_image',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function applies()
    {
        return $this->belongsToMany(Company::class, 'applicants');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'user_comment');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function thanks()
    {
        return $this->hasMany(Thank::class);
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function scouts()
    {
        return $this->hasMany(Scout::class);
    }

    // フォローする
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    
}