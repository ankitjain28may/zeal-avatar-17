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

Route::get('/', function () {

    $img = Image::make('https://scontent-lht6-1.xx.fbcdn.net/v/t1.0-9/15268057_779812755489882_6749697980395923366_n.jpg?oh=9c959caa67950f6daccb614a3fbf60b6&oe=5962E962');

    $height = $img->height();
    $width = $img->width();


    $overlay = Image::make('https://raw.githubusercontent.com/ankitjain28may/Zealicon-Profile-pic/master/dall.png')->resize(603,603);

    $height1 = $overlay->height();
    $width1 = $overlay->width();

    /*return var_dump([
        "image-h" => $height,
        "image-w" => $width,
        "overlay-h" => $height1,
        "overlay-w" => $width1
    ]);*/

    $img->insert($overlay)->resize(300, 300);

    return $img->response('jpg');

    return view('welcome');
});
