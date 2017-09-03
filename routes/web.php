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


Route::get('/', function(){
    return view('index');
});
Route::get('/about', 'AboutController@about');
Route::get('/contact', 'ContactController@contact');

//Route::get('/', [ 'as'=> 'home', function () {
//    return view('welcome');
//}]);

//Route::get('page', 'IndexController@index');

//Route::get('paged/{cat}/{id?}', function($var){
//    echo '<pre>';
//    echo $var;
//    //echo Config::get('app.locale');
//    //print_r($_ENV);
//})->where(['id'=>'[0-9]+', 'cat'=>'[a-zA-z]+']);
//
//
//Route::group(['prefix' => 'admin'], function () {
//    Route::get('user', function ()    {
//        echo 'user';
//    });
//});