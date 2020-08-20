<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\PostRequest;
use App\Info;

class InfoController extends Controller
{
    //
    public function index(){

        return \App\Info::orderBy('id', 'desc')->get();
    }

    public function getInfo(Info $info){

        return $info;
    }

    public function getCompanyInfo(Int $id){
        $company = \App\Company::find($id);
        $info = $company->infos()->orderBy('id', 'desc')->get();
        return $info;
    }

    public function createInfo(PostRequest $request)
    { 

        $info = Info::create([
            'company_id' => Auth::guard('company')->user()->id,
            'title' => $request->title,
            'text' => $request->text
        ]);

        event(new \App\Events\InfoCreated($info));
    }

    public function deleteInfo(Request $request){
        \App\Info::where('id', $request->id)->delete();

        event(new \App\Events\InfoDeleted());
    }
}
