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

/*Route::get('/', function () {



    return view('welcome');
});
*/

Route::get('/', 'Social\SocialController@redirectToProvider');
Route::get('/callback', 'Social\SocialController@handleProviderCallback');

// Route::get('/callback', function() {
//     return "sh";
// });

