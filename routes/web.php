<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\EventController;
use App\Models\Info;
use App\Models\Report;
use App\Models\Content;
use App\Models\Event;
use Illuminate\Support\Collection;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RaitingController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Psr7\Request;

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
Route::get('/journal/list', [JournalController::class, 'list'])->name('journals');
Route::get('/journal/{id}', [JournalController::class, 'single']);
Route::get('/event/list/{id?}', [EventController::class, 'list'])->name('events');
Route::get('/event/{id}', [EventController::class, 'single']);
Route::get('/page/{id}', function ($id) {
    $item = Info::find($id);
    return view("memorandum", compact('item'));
});
Route::get('/users', [UsersController::class, 'list'])->name('users');
Route::get('/user/{id}', [UsersController::class, 'single']);

Route::post('set-raiting', [RaitingController::class, 'raiting']);
Route::post('register', [AuthController::class, 'register']);
Route::post('auth', [AuthController::class, 'auth']);
Route::get('auth/{id}', [AuthController::class, 'comments']);
Route::get('/report/{id}', function ($id) {
    $item = Report::find($id);
    return view("reportSingle", compact('item'));
});
Route::get('/content/{id}', function ($id) {
    $item = Content::find($id);
    return view("contentSingle", compact('item'));
});

Route::get('/material', function () {

    $baners_event = Event::where('status', 1)->get();
    $baners_report = Report::get();
    $baners_content = Content::where('status', 1)->get();

    $c = new Collection;
    $pages = $c->merge($baners_event)->merge($baners_report)->merge($baners_content);
    dd($pages);

    return view("materialList", compact('baners_event', 'baners_report', 'baners_content'));
});
