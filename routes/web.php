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


Route::get('/', 'IndexController@show')->name('promotions');
Route::get('/about', 'AboutController@show')->name('about');
Route::get('/product', 'ProductController@show')->name('product');
Route::get('/parse', 'ParseController@show')->name('parse');

Route::match(['get', 'post'], '/contact', 'ContactController@show')->name('contact');
Route::match(['get', 'post'], '/parse/parseAtb', 'ParseController@parseAtb')->name('parseAtb');
Route::match(['get', 'post'], '/parse/parseSilpo', 'ParseController@parseSilpo')->name('parseSilpo');
Route::match(['get', 'post'], '/parse/parseKlass', 'ParseController@parseKlass')->name('parseKlass');
Route::match(['get', 'post'], '/parse/parsePosad', 'ParseController@parsePosad')->name('parsePosad');
Route::match(['get', 'post'], '/parse/parseBrusnichka', 'ParseController@parseBrusnichka')->name('parseBrusnichka');
Route::match(['get', 'post'], '/parse/parseVelmarket', 'ParseController@parseVelmarket')->name('parseVelmarket');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('catalog', 'CatalogController@catalog')->name('catalog');

Route::post('search', 'SearchController@search')->name('search');

Route::get('/atb', 'ShopPageController@showAtb')->name('atb');
Route::get('/silpo', 'ShopPageController@showSilpo')->name('silpo');
Route::get('/klass', 'ShopPageController@showKlass')->name('klass');
Route::get('/posad', 'ShopPageController@showPosad')->name('posad');
Route::get('/brusnichka', 'ShopPageController@showBrusnichka')->name('brusnichka');
Route::get('/velmarket', 'ShopPageController@showVelmarket')->name('velmarket');
