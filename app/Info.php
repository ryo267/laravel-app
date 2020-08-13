<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    //
    protected $guarded = ['id'];

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
