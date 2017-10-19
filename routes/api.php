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
    return response()->json([
        'code' => 200,
        'status' => 'success',
        'data' => $request->user()
    ]);
});

Route::group([ 'middleware' => [ 'auth:api' ] ], function () {
    Route::resource('users', 'Api\UserController', [ 'except' => 'create', 'edit' ]);
    Route::resource('messages', 'Api\MessageController');
});
