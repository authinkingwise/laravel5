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
    return view('front-contact')->with('STATUS','PENDING');
});
Route::post('/contact', ['uses' => 'EmailController@contactUs']);

// Features page
Route::get('/features', function () {
    return view('front-features');
});

// Privacy Policy page
Route::get('/privacy-policy', function () {
    return view('front-privacy-policy');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

/*
|-------------------------------------
| Tenant
|-------------------------------------
*/
Route::get('/site/register', ['uses' => 'Admin\TenantController@register'])->middleware('guest');
Route::post('/site/create', ['uses' => 'Admin\TenantController@create'])->middleware('guest');
Route::get('/site/tenants', ['uses' => 'Admin\TenantController@index'])->middleware('auth');
Route::delete('/site/tenants/{id}', ['uses' => 'Admin\TenantController@destory'])->where('id', '[0-9]+')->middleware('auth');
Route::get('/site/tenants/{id}', ['uses' => 'Admin\TenantController@show'])->where('id', '[0-9]+')->middleware('auth');
Route::get('/site/tenants/{id}/edit', ['uses' => 'Admin\TenantController@edit'])->where('id', '[0-9]+')->middleware('auth');


/*
|-------------------------------------
| Dashboard
|-------------------------------------
*/
Route::get('/dashboard', ['uses' => 'Admin\DashboardController@index']);

/*
|-------------------------------------
| Ticket
|-------------------------------------
*/
Route::resource('tickets', 'TicketController');
Route::get('/mytickets', ['uses' => 'TicketController@myTickets']);
Route::get('/tickets/get/{id}', ['uses' => 'TicketController@get'])->middleware('auth');

/*
|-------------------------------------
| Account
|-------------------------------------
*/
// Route::get('/account', ['uses' => 'AccountController@index']);
// Route::get('/account/add', ['uses' => 'AccountController@add']);
// Route::get('/account/edit/{id}', ['uses' => 'AccountController@edit']);
// Route::post('/account/delete/{id}', ['uses' => 'AccountController@delete']);
// Route::any('/account/store', ['uses' => 'AccountController@store']);
// Route::any('/account/update/{id}', ['uses' => 'AccountController@update']);

Route::resource('accounts', 'AccountController');

/*
|-------------------------------------
| Permission
|-------------------------------------
*/
Route::resource('permissions', 'PermissionController');

/*
|-------------------------------------
| Role
|-------------------------------------
*/
Route::resource('roles', 'RoleController');

/*
|-------------------------------------
| User
|-------------------------------------
*/
Route::resource('users', 'UserController');
Route::any('/users/{id}/invite', ['uses' => 'UserController@invite']);

/*
|-------------------------------------
| Contact
|-------------------------------------
*/
Route::resource('contacts', 'ContactController');

/*
|-------------------------------------
| Comment
|-------------------------------------
*/
Route::resource('comments', 'CommentController');

/*
|-------------------------------------
| Project
|-------------------------------------
*/
Route::resource('projects', 'ProjectController');

/*
|-------------------------------------
| Task
|-------------------------------------
*/
Route::resource('tasks', 'TaskController');

/*
|-------------------------------------
| Profile
|-------------------------------------
*/
Route::get('/profile', ['uses' => 'ProfileController@show']);
Route::get('/profile/edit', ['uses' => 'ProfileController@edit']);
Route::put('/profile', ['uses' => 'ProfileController@update']);

/*
|-------------------------------------
| Report
|-------------------------------------
*/
Route::get('/reports', ['uses' => 'ReportController@index']);

/*
|-------------------------------------
| Ticket File
|-------------------------------------
*/
Route::resource('ticketfiles', 'TicketFileController');

/*
|-------------------------------------
| Comment File
|-------------------------------------
*/
Route::resource('commentfiles', 'CommentFileController');

/*
|-------------------------------------
| Project File
|-------------------------------------
*/
Route::resource('projectfiles', 'ProjectFileController');

/*
|-------------------------------------
| Settings for the tenant account
|-------------------------------------
*/
Route::get('/settings', ['uses' => 'SettingController@index']);
Route::any('/settings/account', ['uses' => 'SettingController@setAccount']);

/*
|-------------------------------------
| Tenant Billing Address setting
|-------------------------------------
*/
Route::resource('address', 'TenantAddressController');

/*
|-------------------------------------
| Tenant Billing Address setting
|-------------------------------------
*/
Route::resource('notification-settings', 'TenantNotificationSettingController');

/*
|-------------------------------------
| Planning
|-------------------------------------
*/
Route::resource('plannings', 'PlanningController');
