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
    public function index(Request $request){

        $tab = $request->tab;

        if ($tab === 'all-info') {
            return \App\Info::get();
        } else if ($tab === 'new') {
            return \App\Info::orderBy('id', 'desc')->get();
        } else {

            $info1 = \App\Info::where('title', 'like', '%'.$tab.'%')->get();
            $info2 = \App\Info::where('text', 'like', '%'.$tab.'%')->get();
            $infos = $info1->concat($info2)->unique()->sortByDesc('id')->values()->all();
                
            if ( \App\Company::where('screen_name', 'like', '%'.$tab.'%')->exists() ) {
                $companies = \App\Company::where('screen_name', 'like', '%'.$tab.'%')->get();
                $info3 = collect([]);
                foreach($companies as $company){
                    $info4 = $company->infos()->get();
                    $info3 = $info3->concat($info4);
                }
                $infos = $info3->concat($info1)->concat($info2)->unique()->sortByDesc('id')->values()->all();
                return $infos;
            }

            return $infos;
        }
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
