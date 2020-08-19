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

    public function getApplyExists(Int $id, Int $company)
    {

        $user = \App\User::find($id);
        $apply = $user->applies()->where('company_id',$company)->exists();
        
        return $apply;
    }

    public function apply(Request $request)
    {

        $user = \App\User::find($request->userID);
        $user->applies()->attach($request->companyID);
        $apply = $user->applies()->where('company_id',$request->companyID)->exists();
        
        return $apply;
    }
}
