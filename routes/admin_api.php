<?php

$auth = config('admin.authList');

// 账号相关，无需登录认证
Route::post('account/login', 'Admin\AccountController@login');
Route::get('account/logout', 'Admin\AccountController@logout');
Route::get('account/baseinfo', 'Admin\AccountController@getBaseInfo');

// 基础服务
Route::middleware('admin_auth')->group(function () {
    // 图片上传服务
    Route::post('upload', 'CommonController@uploadpic');

    // 账号服务
    Route::post('account/password', 'Admin\AccountController@changePassword');
});

// 车型配置
Route::middleware('admin_auth:' . $auth['car'])->group(function () {
    // 品牌相关
    Route::get('brand/list', 'Admin\BrandController@getList');
    Route::post('brand/add', 'Admin\BrandController@add');
    Route::post('brand/edit', 'Admin\BrandController@edit');
    Route::post('brand/delete', 'Admin\BrandController@delete');
    // 车型相关
    Route::post('car/delete', 'Admin\CarController@delete');
    Route::get('car/list/{brand_id?}/{series_id?}', 'Admin\CarController@getList');
    Route::post('car/add', 'Admin\CarController@add');
    Route::post('car/edit', 'Admin\CarController@edit');
    // 车系名
    Route::get('series/list', 'Admin\SeriesController@getList');
});


// 个人、企业认证相关
Route::middleware('admin_auth:' . $auth['auth'])->group(function () {
    Route::get('auth/list', 'Admin\AuthController@getUserList');
    Route::get('auth/personal', 'Admin\AuthController@getPersonalAuthList');
    Route::post('auth/personal/pass', 'Admin\AuthController@setPersonalPass');
    Route::get('auth/enterprise', 'Admin\AuthController@getEnterpriseAuthList');
    Route::post('auth/enterprise/pass', 'Admin\AuthController@setEnterprisePass');
});

// 常见问题相关
Route::middleware('admin_auth:' . $auth['qa'])->group(function () {
    Route::get('qa/list', 'Admin\QaController@getList');
    Route::get('qa/detail', 'Admin\QaController@get');
    Route::post('qa/add', 'Admin\QaController@add');
    Route::post('qa/edit', 'Admin\QaController@edit');
    Route::post('qa/delete', 'Admin\QaController@delete');
    Route::post('qa/move', 'Admin\QaController@move');
});

// 投诉建议相关
Route::middleware('admin_auth:' . $auth['advice'])->group(function () {
    Route::get('advice/list', 'Admin\AdviceController@getList');
});

// 管理员账户设置
Route::middleware('admin_auth:' . $auth['account'])->group(function () {
    Route::get('account/list', 'Admin\AccountController@getList');
    Route::post('account/create', 'Admin\AccountController@create');
    Route::post('account/delete', 'Admin\AccountController@delete');
    Route::post('account/edit', 'Admin\AccountController@edit');
});

// 订单管理
Route::middleware('admin_auth:' . $auth['order'])->group(function () {
    // 订单列表
    Route::get('order/list/{key?}', 'Admin\OrderController@getList');
});
// 金融方案管理
Route::middleware('admin_auth:' . $auth['paymode'])->group(function () {
});
    Route::post('paymode/delete', 'Admin\PaymodeController@delete');
    Route::post('paymode/add', 'Admin\PaymodeController@add');
    Route::post('paymode/edit', 'Admin\PaymodeController@edit');
    // 列表
    Route::get('paymode/list', 'Admin\PayModeController@getList');
