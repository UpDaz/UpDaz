<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return view('home');
})->name('home');

Route::get('/webflow', function () {
    return view('pages.webflow');
})->name('webflow');

Route::get('/laravel', function () {
    return view('pages.laravel');
})->name('laravel');


Route::post('/contact', [ContactController::class, 'send'])->name('contact');
