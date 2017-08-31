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

// Features page
Route::get('/features', function () {
    return view('front-features');
});

// Privacy Policy page
Route::get('/privacy-policy', function () {
    return view('front-privacy-policy');
});

/*
|-------------------------------------
| Tenant
|-------------------------------------
*/
Route::get('/site/register', ['uses' => 'Admin\TenantController@register']);
Route::post('/site/create', ['uses' => 'Admin\TenantController@create']);
Route::get('/site/tenant', ['uses' => 'Admin\TenantController@index']);
Route::any('/site/tenant/delete/{id}', ['uses' => 'Admin\TenantController@delete'])->where('id', '[0-9]+');

Auth::routes();

Route::get('/home', 'HomeController@index');
