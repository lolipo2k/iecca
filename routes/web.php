<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\EventController;
use App\Models\Info;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/journal/list/{id?}', [JournalController::class, 'list'])->name('journals');
Route::get('/journal/{id}', [JournalController::class, 'single']);
Route::get('/event/list/{id?}', [EventController::class, 'list'])->name('events');
Route::get('/event/{id}', [EventController::class, 'single']);
Route::get('/memorandum', function () {
    $item = Info::find(6);
    return view("memorandum", compact('item'));
})->name('memorandum');
Route::get('/users', [UsersController::class, 'list'])->name('users');
Route::get('/user/{id}', [UsersController::class, 'single']);
