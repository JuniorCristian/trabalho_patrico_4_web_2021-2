<?php

use Illuminate\Support\Facades\{ Route, Auth };

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

Route::middleware('auth')->group(function (){
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
});

Auth::routes();

Route::redirect('/home', '/')->name('home');
