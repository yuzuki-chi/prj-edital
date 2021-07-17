<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolSettingsController;
use App\Http\Controllers\LiveLessonsController;

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

Route::get('/sample/{id}', [SchoolSettingsController::class, 'index']);

Route::get('/live/lesson/{lesson_id}/{session_id}', [LiveLessonsController::class, 'index']);