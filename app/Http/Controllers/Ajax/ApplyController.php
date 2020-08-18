<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    //
    public function getUserApplies(Int $id)
    {

        $user = \App\User::find($id);
        $applies = $user->applies()->get();
        
        return $applies;
    }

    public function getApplicants(Int $id)
    {

        $company = \App\Company::find($id);
        $applicants = $company->applicants()->get();
        
        return $applicants;
    }
}
