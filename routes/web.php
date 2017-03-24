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
//Root
Route::get('/', function() { return view('welcome'); });

//Routes for colol palette generator
Route::get('/color', 'ColorPaletteController@index');
Route::get('/colorsubmit', 'ColorPaletteController@show');

//Routes for random text generator
Route::get('/text', 'LoremTextController@index');
Route::get('/textsubmit', 'LoremTextController@show');

//Routes for random data generator
Route::get('/data', 'RandDataController@index');
Route::get('/datasubmit', 'RandDataController@show');

//log viewer
if (getenv('APP_ENV')=='local') {
  Route::get('logs', '\Melihovv\LaravelLogViewer\LaravelLogViewerController@index');
}
