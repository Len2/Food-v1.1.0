<?php

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

Route::get('/test', function () {
  //print_r(phpinfo());
});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test',[
//    'uses' => 'Api\ACL\LoginController@test'
//]);
//
//Route::get('/test', function () {
////    $redis = app()->make('redis');
////    $redis->set("key1","testValue");
////    return $redis->get("key1");
//    return phpinfo();
//});