<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CompanyHomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('company.index');
    }
}
