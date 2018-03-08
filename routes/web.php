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

Route::any('/',  function() {
    return view('auth.login');
});

Route::get('/map', 'SearchController@map');
Route::get('/search', 'SearchController@search_city_address');
Route::get('/distance', 'SearchController@searchDis');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/agency', 'AgencyController@getTypes');

Route::get('/agency/offers', 'AgencyController@getOffers');

Route::post('/agency/add', 'AgencyController@add');
Route::post('/agency/edit/{offer_id}', 'AgencyController@edit');
Route::get('/agency/edit/{offer_id}', 'AgencyController@getEdit');
Route::any('/agency/delete/{offer_id}', 'AgencyController@delete');
Route::get('/agency/show/{offer_id}', 'AgencyController@show');
Route::post('/agency/upload/floor/plan/{offer_id}', 'AgencyController@upload_floor_plan');
Route::post('/agency/upload/{offer_id}','AgencyController@upload');
Route::get('/admin/agency/get', 'AdminController@getAgency');
Route::get('/admin', 'AdminController@showDash');
Route::get('/admin/listings', 'AdminController@getOffers');
Route::get('/admin/listings/view/{offer_id}', 'AdminController@showOffer');
Route::get('/admin/listings/edit/{offer_id}', 'AdminController@getEditOffer');
Route::post('/admin/listings/edit/{offer_id}', 'AdminController@editOffer');
Route::post('/admin/listings/add', 'AdminController@addOffer');
Route::any('/admin/listings/delete/{offer_id}', 'AdminController@deleteOffer');
Route::any('/admin/search', 'AdminController@search');
Route::any('/admin/agency', 'AdminController@showAgency');
Route::post('/admin/add', 'AdminController@addOffer');
Route::get('/admin/add/new', 'AdminController@addNew');
Route::any('/admin/configuration', 'InteresController@retrieve');
Route::get('/admin/change', 'AdminController@changePass');
Route::post('/admin/change/password', 'AdminController@changePassword');
Route::get('/admin/agency/add', 'AdminController@agencyAdd');
Route::post('/admin/agency/add', 'AdminController@addAgency');
Route::get('/admin/agency/edit/{id_agency}', 'AdminController@getEditAgency');
Route::post('/admin/agency/edit/{id_agency}', 'AdminController@editAgency');
Route::any('/admin/agency/delete/{id_user}', 'AdminController@deleteAgency');
Route::get('/admin/blog', 'BlogController@index');
Route::get('/admin/blog/category/add', 'BlogController@addCategory' );
Route::post('/admin/blog/category/add', 'BlogController@addCat' );
Route::get('/admin/blog/category/edit/{id_category}', 'BlogController@editCategory');
Route::get('/admin/blog/posts/add', 'BlogController@addPosts');
Route::post('/admin/blog/posts/add', 'BlogController@addPost');
Route::get('/admin/blog/posts/edit/{id_post}', 'BlogController@editPosts');
Route::post('/admin/blog/posts/edit/{id_post}', 'BlogController@editPost');
Route::get('/admin/blog/post/{id_post}','BlogController@showPosts');

Route::get('/storage/{filename}', function ($filename)
{
    $path = storage_path('public/storage/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
