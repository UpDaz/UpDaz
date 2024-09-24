<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
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

Route::get(
    '/',
    function () {
        return view('pages.home');
    }
)->name('home');

Route::get(
    '/webflow',
    function () {
        return view('pages.webflow');
    }
)->name('webflow');

Route::get(
    '/laravel',
    function () {
        return view('pages.laravel');
    }
)->name('laravel');

Route::get(
    '/prestashop',
    function () {
        return view('pages.prestashop');
    }
)->name('prestashop');

Route::get(
    '/contact',
    function () {
        return redirect('/');
    }
);

Route::get(
    '/mentions-legales',
    function () {
        return view('pages.legal-notices');
    }
)->name('legal-notices');

Route::post('/contact', [ContactController::class, 'send'])->name('contact');

Route::get(
    '/articles',
    [ArticlesController::class, 'index']
)->name('articles');

Route::get(
    '/articles/{slug}',
    [CategoryController::class, 'show']
)->name('category');

Route::get(
    '/articles/{categorySlug}/{slug}',
    [ArticlesController::class, 'show']
)->name('article');
