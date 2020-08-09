<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/home/{any}', function () {
    return view('studyService/index');
})->where('any', '.*');
*/
//Route::resource('studyService','studyServiceController');
Route::post('studyService/follow/{id}', 'studyServiceController@follow')->name('follow');
Route::delete('studyService/unfollow/{id}', 'studyServiceController@unfollow')->name('unfollow');


Route::get('ajax/comment/{id}','Ajax\CommentController@index');
Route::get('ajax/comments/{id}','Ajax\CommentController@getComments');
Route::post('ajax/comment','Ajax\CommentController@store');

Route::get('ajax/thanks/{comment}','Ajax\ThankController@getThanks');
Route::post('ajax/thanks','Ajax\ThankController@giveThanks');

Route::get('ajax/favo/{postID}/{userID}','Ajax\FavoriteController@index');
Route::post('ajax/favo/add','Ajax\FavoriteController@addFavo');
Route::delete('ajax/favo/delete/{postID}/{userID}','Ajax\FavoriteController@deleteFavo');

Route::get('ajax/info','Ajax\InfoController@index');
Route::get('ajax/info/{info}','Ajax\InfoController@getInfo');
Route::post('ajax/info/company','Ajax\InfoController@createInfo');
Route::delete('ajax/info/delete/{id}','Ajax\InfoController@deleteInfo');

Route::get('ajax/chat','Ajax\ChatController@index');
Route::post('ajax/chat','Ajax\ChatController@create');

Route::get('ajax/user','Ajax\UserController@index');
Route::get('ajax/user/all/{tab}','Ajax\UserController@getUsers');
Route::get('ajax/user/skill','Ajax\UserController@getSkill');

Route::get('ajax/user/{id}','Ajax\UserController@profile');
Route::get('ajax/user/posts/count/{id}','Ajax\UserController@getPostsCount');
Route::get('ajax/user/follow/count/{id}','Ajax\UserController@getFollowCount');
Route::get('ajax/user/follower/count/{id}','Ajax\UserController@getFollowerCount');
Route::get('ajax/user/thanks/count/{id}','Ajax\UserController@getThanksCount');
Route::get('ajax/user/follow/{userID}/{me}','Ajax\UserController@getFollow');
Route::put('ajax/user/{user}','Ajax\UserController@update');
Route::post('ajax/user/skill','Ajax\UserController@addSkill');
Route::post('ajax/user/follow','Ajax\UserController@follow');
Route::delete('ajax/user/skill/delete/{progress}','Ajax\UserController@deleteSkill');
Route::delete('ajax/user/follow/remove/{id}','Ajax\UserController@reFollow');

Route::get('ajax/company','Ajax\CompanyController@getProfile');
Route::get('ajax/company/all/','Ajax\CompanyController@index');
Route::get('ajax/company/infos/count/{id}','Ajax\CompanyController@getInfosCount');
Route::get('ajax/company/{company}','Ajax\CompanyController@getCompany');
Route::put('ajax/company/{company}','Ajax\CompanyController@update');

Route::get('ajax/post/all/{tag}','Ajax\PostController@index');
//Route::post('ajax/post/reload','Ajax\PostController@reload');
Route::get('ajax/post/{post}','Ajax\PostController@getPost');
Route::put('ajax/post/{post}','Ajax\PostController@update');
Route::post('ajax/post','Ajax\PostController@create');

Route::delete('ajax/post/delete/{id}','Ajax\PostController@deletePost');

Route::prefix('company')->namespace('Company')->name('company.')->group(function(){
    Auth::routes();

    Route::get('/home', 'CompanyHomeController@index')->name('company_home');
});
Auth::routes();
Route::get('ajax/tag','Ajax\TagController@index');
Route::get('ajax/tag/{id}','Ajax\TagController@getTag');
Route::put('ajax/tag','Ajax\TagController@update');

Route::get('/profile', 'ProfileController@index');
Route::post('/profile', 'ProfileController@store');
Route::post('/company/profile', 'ProfileController@storeCompany');
Route::post('/profile/back', 'ProfileController@storeBack');
Route::post('/company/profile/back', 'ProfileController@storeBackCompany');

Route::get('/home', 'HomeController@index')->name('home');

