<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('users', 'API\UserController');
Route::get('user/recent', 'API\UserController@recent');
Route::apiResources(['user'=>'API\UserController']);
Route::get('member/getAllMembers', 'API\MemberController@getAllMembers');
Route::get('member/getParentMembers/{id}', 'API\MemberController@getParentMembers');

//Route::post('member/addMember', 'API\UserController@addMember');
Route::post('member/saveMember', 'API\MemberController@addMember');

Route::post('member/saveParentChild', 'API\MemberController@addParentChildMember');
Route::put('member/updateParentChild/{id}', 'API\MemberController@updateParentChildMember');
Route::get('member/searchMember', 'API\MemberController@getSearchedMembers');


Route::get('member/getFamilyMembers', 'API\MemberController@getFamilyMembers');
Route::get('member/getFamilyTree/{type}', 'API\MemberController@getFamilyTree');

Route::post('member/updateMember/{id}', 'API\MemberController@updateMember');
Route::put('member/updateMember/{id}', 'API\MemberController@updateMember');
Route::apiResources(['member'=>'API\MemberController']);
// Route::apiResources(['member'=>'API\MemberController']);



