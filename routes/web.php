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
    return view('welcome');
});

Route::get('/users', function (){
    return [
        'users' => [
            [
              \App\User::where('name','Arthur')->first(),
            ]
        ]
    ];
});
Route::middleware ('auth', 'verified')->group (function () {
    Route::resource ('profile', 'ProfileController', [
        'only' => ['edit', 'update', 'destroy', 'show'],
        'parameters' => ['profile' => 'user']
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

