<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scout extends Model
{
    //
    use SoftDeletes;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
