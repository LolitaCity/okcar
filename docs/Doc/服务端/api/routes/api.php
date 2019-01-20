<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

use Illuminate\Http\Request;

Route::get('v1/logout', 'AccountController@logout');

Route::get('v1/profile', 'AccountController@profile');

Route::post('v1/register/update', 'AccountController@registerUpdate');

Route::post('v1/uploadpic', 'CommonController@uploadpic');

Route::post('v1/realname_authentication/submit', 'AccountController@realnameAuthentication');


Route::post('v1/enterprise_authentication/submit', 'AccountController@enterpriseAuthentication');

Route::post('v1/publish/create', 'CarController@publishCreate');

Route::post('v1/publish/update', 'CarController@publishUpdate');

Route::post('v1/publish/delete', 'CarController@publishDelete');

Route::post('v1/publish/down', 'CarController@publishDown');

Route::post('v1/publish/up', 'CarController@publishUp');

Route::get('v1/publish/list', 'CarController@publishList');

Route::post('v1/favour', 'CarController@favour');

Route::get('v1/favourlist', 'CarController@favourlist');


Route::post('v1/advice', 'CommonController@advice');



Route::post('v1/order/create', 'FinanController@orderCreate');

Route::post('v1/realname_authentication/update', function (Request $request) {
    $user = Auth::user();
    $status = $request->input('status');
    $ret = \App\Models\RealnameAuthentication::where('user_id', $user->id)->update(['status' => $status]);
    if ($ret) {
        return Response::json(['err' => 0]);
    }
});


Route::post('v1/enterprise_authentication/update', function (Request $request) {
    $user = Auth::user();
    $status = $request->input('status');
    $ret = \App\Models\EnterpriseAuthentication::where('user_id', $user->id)->update(['status' => $status]);
    if ($ret) {
        return Response::json(['err' => 0]);
    }
});

