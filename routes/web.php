<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

if (App::environment('local')) {
    Auth::routes();
} else {
    Auth::routes(['register' => false]);
}

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/books/{book}/rate', 'BookController@rate')->name('books.rate');
// Route::post('/elections/{election}/storevote', 'ElectionController@storevote')->name('election.storevote');

Route::resource('books', 'BookController')->middleware('auth');
Route::resource('books.rates', 'RateController')->middleware('auth');
Route::resource('elections', 'ElectionController')->middleware('auth');
Route::resource('elections.votes', 'VoteController')->middleware('auth');

