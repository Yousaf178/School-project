
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubjectController;

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// Students
Route::resource('students', StudentController::class);
// Subjects
Route::resource('subjects', SubjectController::class);

// Student ID double-click update
Route::put(
    '/students/{student}/student-id',
    [StudentController::class, 'updateStudentId']
)->name('students.updateStudentId');


Route::get('/subjects/{subject}/teachers', [SubjectController::class, 'teachers'])
    ->name('subjects.teachers');

// Student Education double-click update
Route::put(
    '/students/{student}/education',
    [StudentController::class, 'updateEducation']
)->name('students.updateEducation');


// Student PDF download
Route::get(
    '/students/{student}/download',
    [StudentController::class, 'download']
)->name('students.download');


// Teachers
Route::resource('teachers', TeacherController::class);