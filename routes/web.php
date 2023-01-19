<?php

use App\Http\Controllers\Effort\AccentController;
use App\Http\Controllers\Effort\ActiveController;
use App\Http\Controllers\Effort\AllController;
use App\Http\Controllers\Effort\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [StudentController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**
 * 全般
 */

Route::get('/draw', function(){
    return view('draw');
});

/**
 * 全員のノートを１画面に出す
 */
Route::get('/teacher/view/all', [AllController::class, 'index']);
Route::get('/teacher/view/note/{id}', [IndexController::class, 'index']); //個人のノートを見るためのページ：未実装

/**
 * 筆記から手を離してからの時間
 */
Route::get('/teacher/view/active', [ActiveController::class, 'index']);

/**
 * 変わった解き方をしている人を見つける
 */
Route::get('/teacher/view/accent', [AccentController::class, 'index']);


Route::get('/student', [StudentController::class, 'index']);
Route::post('/student/create', [StudentController::class, 'create']);