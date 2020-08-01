<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    //
    use SoftDeletes;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
}
