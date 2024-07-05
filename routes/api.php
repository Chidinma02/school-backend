<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\TeacherController;
// use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AssignmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/add-teacher', [AdminController::class, 'addTeacher']);
    Route::delete('/admin/delete-teacher/{id}', [AdminController::class, 'deleteTeacher']);
    Route::post('/admin/post-news', [AdminController::class, 'postNews']);

    Route::post('/teacher/mark-attendance', [TeacherController::class, 'markAttendance']);
    Route::post('/teacher/post-assignment', [TeacherController::class, 'postAssignment']);
    // Route::post('/teacher/post-assignment', [AssignmentController::class, 'postAssignment']);

    Route::get('/teacher/give-score/{assignment_id}/{student_id}', [TeacherController::class, 'giveScore']);
    // Route::get('/teacher/give-score', [TeacherController::class, 'giveScore']);
  
    Route::get('/student/view-assignments', [StudentController::class, 'viewAssignments']);
    Route::post('/student/submit-assignment', [StudentController::class, 'submitAssignment']);

    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/attendances', [AttendanceController::class, 'index']);
    
});
Route::get('/alladmins',[AdminController::class, 'alladmin']);



Route::get('/check', function () {
    return "chidi";
});