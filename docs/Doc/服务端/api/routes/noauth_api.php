<?php

/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/12
 * Time: 0:09
 */

Route::post('v1/sendcode', 'CommonController@sendcode');

Route::get('v1/config', function () {
    $config = array_merge(['arealist' => config('arealist')], config('okcar_const'));
    return response()->json($config);
});

Route::post('v1/login', 'AccountController@login');

Route::get('v1/modellist', 'CarController@modellist');

Route::get('v1/model_appearance_info', 'CarController@modelAppearanceInfo');

Route::get('v1/model_decoration_info', 'CarController@modelDecorationInfo');

Route::get('v1/publish/detail', 'CarController@publishDetail');

Route::get('v1/search', 'CarController@search');

Route::get('v1/search_count', 'CarController@searchCount');

Route::get('v1/qa/list', 'Admin\QaController@getList');

Route::get('v1/qa/detail', 'Admin\QaController@get');

Route::get('v1/sim_price_publish','CarController@simPricePublish');

Route::get('v1/paymodelist', 'FinanController@payModelList');



