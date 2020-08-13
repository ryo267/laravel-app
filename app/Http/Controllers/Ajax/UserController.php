<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use \App\Http\Requests\UserRequest;
use App\Progress;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    //
    public function index()
    {

        if (Auth::check()) {

            $user = \App\User::find(Auth::id());

            //$client = new \GuzzleHttp\Client();

            $url = 'http://qiita.com/api/v2/items?page=1&per_page=10';
            /*
            $response = $client->request(
                'GET',
                $url, // URLを設定
                //['query' => $params] // パラメーターがあれば設定 ?foo=barの場合は $params = ['foo' => 'bar']
            );
            */

            //$response = Http::get('https://qiita.com/api/v2/items?page=1&per_page=20&query=qiita+user%3AQiita');
            $response = Http::get('https://qiita.com/api/v2/items?', [
                'page' => '1',
                'per_page' => '20',
                'query' => 'laravel',
            ]);
            /*
            echo $response->getStatusCode(); // 200
            echo $response->getReasonPhrase(); // OK
            echo $response->getProtocolVersion(); // 1.1
            */
            //echo $response->status(); // 200
            //echo $response->successful(); // OK
            // レスポンスボディを取得
            //$responseBody = $response->getBody()->getContents();
            $responseBody = $response->json();

            //var_dump($responseBody);

            return $user;
        } else {
            return \App\User::where('id', 1)->get();
        }
    }

    public function getUsers(Request $request)
    {
        $tab = $request->tab;

        if ($tab === 'all-users') {
            
            $users = \App\User::orderBy('id', 'asc')->get(['id','screen_name']);
            
            return $users;

        } else if ($tab === 'follower') {

            $users = \App\User::withCount('followers')->orderBy('followers_count', 'desc')->get(['id']);

            return $users;
        } else if ($tab === 'thanks') {

            $users = \App\User::withCount('thanks')->orderBy('thanks_count', 'desc')->get(['id']);

            return $users;
        } else if ($tab === 'post') {

            $users = \App\User::withCount('posts')->orderBy('posts_count', 'desc')->get(['id']);

            return $users;
        } else if ($tab === 'new-registration') {

            $users = \App\User::orderBy('id', 'desc')->get(['id']);

            return $users;
        }
    }

    public function update(UserRequest $request, User $user)
    {

        $user->update($request->all());

        return $user;
    }

    public function profile(User $id)
    {
        return $id;
    }


    public function addSkill(Request $request)
    {
        $request->validate([
            'skill_name' => 'required ',
            'progress' => 'required | integer | between:1,100',
        ]);

        $skill = \App\Skill::firstOrCreate([
            'name' => $request->skill_name,
        ]);

        \App\Progress::create([
            'user_id' => Auth::id(),
            'skill_id' => $skill->id,
            'name' => $skill->name,
            'progress' => $request->progress,
        ]);

        Auth::user()->skills()->attach($skill->id);

        $progress = \App\Progress::where('user_id', Auth::id())->get();

        return $progress;
    }

    public function getSkill(Int $id)
    {
        $progress = \App\Progress::where('user_id', $id)->get();

        return $progress;
    }

    public function deleteSkill(Progress $progress)
    {
        Auth::user()->skills()->detach($progress->skill_id);

        $progress->delete();

        $progress = \App\Progress::where('user_id', Auth::id())->get();

        return $progress;
    }

    public function getFollow(Int $userID, Int  $me)
    {

        $follow_flag = \App\Follower::where('following_id', $me)->where('followed_id', $userID)->exists();

        return $follow_flag;
    }

    public function follow(Request $request)
    {
        if (Auth::id() != $request->userID) {

            Auth::user()->follows()->attach($request->userID);
            $follower_count = \App\Follower::where('followed_id', $request->userID)->count();
            $follow_flag = \App\Follower::where('following_id', Auth::id())->where('followed_id', $request->userID)->exists();

            return [$follower_count, $follow_flag];
        }

        $follower_count = \App\Follower::where('followed_id', $request->userID)->count();
        $follow_flag = \App\Follower::where('following_id', Auth::id())->where('followed_id', $request->userID)->exists();

        return [$follower_count, $follow_flag];
    }

    public function reFollow(Int $id)
    {
        Auth::user()->follows()->detach($id);

        $follower_count = \App\Follower::where('followed_id', $id)->count();
        $follow_flag = \App\Follower::where('following_id', Auth::id())->where('followed_id', $id)->exists();

        return [$follower_count, $follow_flag];
    }

    public function getPostsCount(Int $id)
    {
        $count = \App\Post::where('user_id', $id)->count();
        return $count;
    }

    public function getFollowCount(Int $id)
    {
        $count = \App\Follower::where('following_id', $id)->count();
        return $count;
    }

    public function getFollowerCount(Int $id)
    {
        $count = \App\Follower::where('followed_id', $id)->count();
        return $count;
    }

    public function getThanksCount(Int $id)
    {
        $user = \App\User::find($id);
        $comments = $user->comments;
        $count = 0;
        foreach ($comments as $comment) {
            $count += $comment->thanks()->count();
        }
        return $count;
    }

    public function getScout(Int $userID, Int $me)
    {

        $company = \App\Company::find($me);
        $scout_flag = $company->scouts()->where('user_id', $userID )->exists();
        
        return $scout_flag;
    }

    public function scout(Request $request)
    {

        $scout = \App\Scout::create([
            'company_id' => $request->companyID,
            'user_id' => $request->userID,
            'text' => $request->text,
        ]);

        $company = \App\Company::find($request->companyID);
        $scout_flag = $company->scouts()->where('user_id', $request->userID )->exists();
        
        return $scout_flag;
    }
}
