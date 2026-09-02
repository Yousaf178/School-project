<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;


// Login
// Route::get('/login', [LoginController::class, 'showLogin'])
    // ->name('login');

// Route::post('/login', [LoginController::class, 'login'])
    // ->name('login.submit');


// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// Home
// Route::get('/', function () {
//     return redirect()->route('login');
// });


// Students
// Route::middleware('auth')->group(function () {

    Route::resource('students', StudentController::class);

    // Double-click Student ID
    Route::put(
        '/students/{student}/student-id',
        [StudentController::class, 'updateStudentId']
    )->name('students.updateStudentId');

Route::put(
    '/students/{student}/education',
    [StudentController::class, 'updateEducation']
)->name('students.updateEducation');
// });