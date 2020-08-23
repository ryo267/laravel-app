<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Http;
use App\Company;

class CompanyController extends Controller
{
    //
    public function index()
    {
        return \App\Company::orderBy('id', 'asc')->get(['id']);
    }

    public function getCompany(Company $company)
    {
        return $company;
    }

    public function getProfile()
    {

        $company = Auth::guard('company')->user();
        
        //$infos = \App\Info::where('company_id', Auth::guard('company')->user()->id )->orderBy('created_at', 'DESC')->get();

        /*
        $url = 'http://qiita.com/api/v2/items?page=1&per_page=10';

        $response = Http::get('https://qiita.com/api/v2/items?', [
            'page' => '1',
            'per_page' => '20',
            'query' => 'laravel',
        ]);
        $responseBody = $response->json();
        */

        return $company;
    }

    public function update(CompanyRequest $request, Company $company)
    {

        //var_dump($user);
        //dd($request->all());

        $company->update($request->all());

        return $company;
    }

    public function getInfosCount(Int $id){
        $count = \App\Info::where('company_id', $id )->count();
        return $count;
    }
}
