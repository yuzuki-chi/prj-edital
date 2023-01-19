<?php

use App\Http\Controllers\Effort\ActiveController;
use App\Http\Controllers\Effort\IndexController;
use App\Http\Controllers\Effort\UpdateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Effort;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/trylog_all', function() {
    return Effort::all();
});

Route::post('/trylog', [UpdateController::class, 'update']);

/**
 *  ページ単位でEffortの取得
 */
Route::get('/trylog/{student_id}/{page_num}', [IndexController::class, 'getByStudentIdAndPageNum']);

/* Student */
Route::get('/student', function() {
    return Student::all();
});
Route::get('/student/id/{student_id}', [StudentController::class, 'getById']);
Route::post('/student', [StudentController::class, 'store']);

Route::get('/student/active/{student_id}', [ActiveController::class, 'getById']); //最後の筆跡からの経過時間

/* Teacher */
Route::get('/teacher', function(){
    return Teacher::all();
});
Route::get('/teacher/id/{teacher_id}', [TeacherController::class, 'getById']);
Route::post('/teacher', [TeacherController::class, 'store']);