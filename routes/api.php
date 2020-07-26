<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::delete('/v1/books/{book}', 'BookController@delete')->middleware('auth:api');
Route::get('/v1/books/list', 'BookController@list')->middleware('auth:api');

Route::delete('/v1/elections/{election}', 'ElectionController@delete')->middleware('auth:api');
Route::get('/v1/elections/list', 'ElectionController@list')->middleware('auth:api');

Route::get('/v1/elections/{election}/votes/list', 'VoteController@indexList')->middleware('auth:api');