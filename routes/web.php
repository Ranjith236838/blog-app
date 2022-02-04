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


Auth::routes();

Route::get('/somethingfornow', function () {
    return view('posts.index');
});

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index']);

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit']);

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);

Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::patch('/p/{post}', [App\Http\Controllers\PostsController::class, 'update']);

Route::get('p/{post}/delete', [App\Http\Controllers\PostsController::class, 'delete']);

Route::get('/p/{post}/edit', [App\Http\Controllers\PostsController::class, 'edit']);

Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::post('/search', [App\Http\Controllers\SearchController::class, 'index']);