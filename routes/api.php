<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'LoginController@login');
    Route::post('/signup', 'LoginController@signup');
    Route::post('/hash', 'LoginController@hashmake');
    Route::post('/loginn', 'LoginController@loginMobile');
    Route::post('/token', 'LoginController@tokenExpire');
});

Route::group(['prefix' => 'public'], function () {
    Route::post('/appointment', 'AppointmentController@make_appointment');
    Route::post('/map', 'SearchController@map');
    Route::get('/offers', 'SearchController@offers');
    Route::post('/distance', 'SearchController@retrieveDis');
    Route::post('/search', 'SearchController@search_city_address');
    Route::post('/advancedSearch', 'SearchController@advanced_search');
    Route::post('/interes', 'InteresController@get');
    Route::post('/interes/edit/{id_interes}', 'InteresController@edit');
    Route::post('/interes/delete/{id_interes}', "InteresController@delete");
    Route::any('/nearby/{offer_id}', 'SearchController@nearby_properties');
    Route::post('/admin/blog/posts/add', 'BlogController@addPost');

});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::group(['prefix' => 'myhome'], function () {
        Route::post('user/edit', 'UserController@edit');
        Route::post('user/delete', 'UserController@delete');
        Route::post('user', 'UserController@index');
        Route::post('admin/interes/create', 'InteresController@create');
        Route::post('admin/interes/retrieve', 'InteresController@retrieve');
        Route::post('admin/interes/{id_interes}/edit', 'InteresController@edit');
        Route::post('admin/interes/{id_interes}/delete', 'InteresController@delete');
    });
});

Route::get('storage/app/public/{filename}', function ($filename)
{
    $path = storage_path('public' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
