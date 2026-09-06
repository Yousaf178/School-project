<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassSubjectController;

// =========================
// Logout
// =========================

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// =========================
// Students
// =========================

Route::resource('students', StudentController::class);


// Student ID double-click update
Route::put(
    '/students/{student}/student-id',
    [StudentController::class, 'updateStudentId']
)->name('students.updateStudentId');


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


// =========================
// Subjects
// =========================

Route::resource('subjects', SubjectController::class);

Route::get(
    '/subjects/{subject}/teachers',
    [SubjectController::class, 'teachers']
)->name('subjects.teachers');


// =========================
// Classes
// =========================

Route::resource('classes', SchoolClassController::class);


// =========================
// Enrollments
// =========================

Route::resource('enrollments', EnrollmentController::class);


// =========================
// Attendance
// =========================

// Daily attendance page
Route::get(
    '/attendances/daily',
    [AttendanceController::class, 'daily']
)->name('attendances.daily');

// Save daily attendance
Route::post(
    '/attendances/daily/save',
    [AttendanceController::class, 'saveDaily']
)->name('attendances.saveDaily');

// Normal attendance CRUD
Route::resource('attendances', AttendanceController::class);


// =========================
// Teachers
// =========================

Route::resource('teachers', TeacherController::class);

Route::get(
    '/class-subjects',
    [ClassSubjectController::class, 'index']
)->name('class-subjects.index');

Route::get(
    '/class-subjects/create',
    [ClassSubjectController::class, 'create']
)->name('class-subjects.create');

Route::post(
    '/class-subjects',
    [ClassSubjectController::class, 'store']
)->name('class-subjects.store');

Route::delete(
    '/class-subjects/{classSubject}',
    [ClassSubjectController::class, 'destroy']
)->name('class-subjects.destroy');