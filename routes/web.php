<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CourseOfferingController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrationCourseController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('academic-years', AcademicYearController::class);
    Route::resource('students', StudentController::class);
    Route::resource('semesters', SemesterController::class);
    Route::resource('course-offerings', CourseOfferingController::class);
    Route::resource('registrations', RegistrationController::class);
    Route::resource('registration-courses', RegistrationCourseController::class);
});