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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home page ----> front-home
Route::get('/', function () {
    return view('front-home');
});

// Pricing page ----> front-pricing
Route::get('/pricing', function () {
	return view('front-pricing');
});

// Contact page ----> front-contact
Route::get('/contact', function () {
	return view('front-contact');
});
