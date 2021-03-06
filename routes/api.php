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

/**
 * 新增路由信息
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-16
 */

//仓库接口
Route::post('v1/creathouse','Api\StoreHouseController@creatStoreHouse');
Route::post('v1/gethouselist','Api\StoreHouseController@getStoreHouseList');
Route::post('v1/getStoreHouseInfo','Api\StoreHouseController@getStoreHouseInfo');
Route::post('v1/editStoreHouse','Api\StoreHouseController@editStoreHouse');
Route::post('v1/deleteStoreHouse','Api\StoreHouseController@deleteStoreHouse');

//地区列表
Route::post('v1/getarealist','Api\AreaController@getAreaList');
Route::post('v1/getareainfo','Api\AreaController@getAreaInfo');
#@Lee
Route::post('v1/getareahouselist','Api\AreaController@getareaStoreHouseList');
Route::post('v1/test','Api\AreaController@test');
Route::post('v1/test1','Api\AreaController@test1');

//订单
Route::post('v1/getorderlist','Api\OrderController@getOrderList');
Route::post('v1/getorderinfo','Api\OrderController@getOrderInfo');
Route::post('v1/createorder','Api\OrderController@createOrder');
Route::post('v1/editorder','Api\OrderController@editOrder');
Route::post('v1/deleteorder','Api\OrderController@deleteOrder');
Route::post('v1/setorderstatus','Api\OrderController@setOrderStatus');
Route::post('v1/getorderdetailedinfo','Api\OrderController@getOrderDetailedInfo');
Route::post('v1/getorderaddress','Api\OrderController@getOrderAddress');