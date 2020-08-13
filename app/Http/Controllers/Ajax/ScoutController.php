<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Scout;

class ScoutController extends Controller
{
    //
    public function getUserScouts(Int $id)
    {

        $user = \App\User::find($id);
        $scout = $user->scouts()->orderBy('id', 'desc')->get(['id','company_id']);
        
        return $scout;
    }

    public function getScoutData(Scout $scout)
    {
        return $scout;
    }

    public function getCompanyScout(Int $id)
    {

        $company = \App\Company::find($id);
        $scout = $company->scouts()->orderBy('id', 'desc')->get(['id','user_id']);
        
        return $scout;
    }
}
