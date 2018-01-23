<?php

use Illuminate\Http\Request;

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

/*Route:middleware:('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group(['namespace' => 'Api'], function(){
    Route::any('biz_licenseocr', 'AiController@tencent_biz_licenseocr');
    Route::any('id_card', 'AiController@tencent_id_card');
    Route::any('name_card', 'AiController@tencent_name_card');
    Route::any('credit_card', 'AiController@tencent_credit_card');

    Route::get('get_sms', 'SmsController@get_sms');
    Route::post('post_sms', 'SmsController@post_sms');

    Route::get('wechat', 'WechatController@index');
});





