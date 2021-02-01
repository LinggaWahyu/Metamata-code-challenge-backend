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

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Stories\StoryController::class, 'index'])->name('home');
    Route::post('/', [App\Http\Controllers\Stories\StoryController::class, 'store'])->name('story.create');
    Route::get('/{id}/like', [App\Http\Controllers\Stories\StoryController::class, 'like'])->name('story.like');
    Route::get('/my-stories', [App\Http\Controllers\Stories\StoryController::class, 'my_stories'])->name('story.my-stories');
});


