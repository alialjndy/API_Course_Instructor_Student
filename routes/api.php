<?php

use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthStudentController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Student\ActionStudentController;
use App\Http\Middleware\CrudCourseMiddleware;
use App\Http\Middleware\CrudInstructorMiddleware;
use App\Http\Middleware\CrudStudentMiddleware;
use App\Http\Middleware\StudentMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('admin/login',[AdminLoginController::class, 'login']);
Route::post('student/login',[StudentLoginController::class,'login']);

//Admin Logout And info
Route::get('AdminInfo',[AuthController::class, 'me']);
Route::post('Adminlogout',[AuthController::class ,'logout']);

// Student logout and info
Route::get('StudentInfo',[AuthStudentController::class, 'me']);
Route::post('Studentlogout',[AuthStudentController::class ,'logout']);

Route::middleware([CrudStudentMiddleware::class])->group(function(){
    Route::apiResource('students',StudentController::class);
    Route::post('student/{id}/course',[StudentController::class, 'registerStudentInCourse']);
});

Route::middleware([CrudInstructorMiddleware::class])->group(function(){
    Route::apiResource('instructors',InstructorController::class);
    Route::get('instructors/{instructor_id}/course',[InstructorController::class,'showCourseRelatedWithInstructor']);
    Route::get('instructors/{instructor_id}/student',[InstructorController::class,'showStudentRelatedWithInstructor']);
});

//
Route::middleware([CrudCourseMiddleware::class])->group(function(){
    Route::apiResource('courses',CourseController::class);
});

Route::middleware([StudentMiddleware::class])->group(function(){
    Route::get('AllCourse',[ActionStudentController::class,'index']);
    Route::get('FetchCourse/{course_id}',[ActionStudentController::class, 'show']);
});
