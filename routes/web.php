<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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

// Schedule routes
Route::get('/', [ScheduleController::class, 'index'])
    ->name('schedule.show_schedule');

Route::get('/schedule_create', [ScheduleController::class, 'create'])
    ->name('schedule.schedule_create');

Route::post('/schedule_store', [ScheduleController::class, 'store'])
    ->name('schedule.schedule_store');

Route::get('/schedule_edit/{id}', [ScheduleController::class, 'edit'])
    ->name('schedule.schedule_edit');

Route::post('/schedule_update/{id}', [ScheduleController::class, 'update'])
    ->name('schedule.schedule_update');

Route::post('/schedule_delete/{id}', [ScheduleController::class, 'destroy'])
    ->name('schedule.schedule_delete');
// End Schedule routes


// Teachers routes
Route::get('/teacher_show', [TeacherController::class, 'teacher_show'])
        ->name('teacher.teacher_show');

Route::get('/teacher_create', [TeacherController::class, 'teacher_create'])
        ->name('teacher.teacher_create');

Route::post('/teacher_store', [TeacherController::class, 'teacher_store'])
        ->name('teacher.teacher_store');

Route::get('/teacher_edit/{id}', [TeacherController::class, 'teacher_edit'])
        ->name('teacher.teacher_edit');

Route::post('/teacher_update/{id}', [TeacherController::class, 'teacher_update'])
        ->name('teacher.teacher_update');

Route::post('/teacher_delete/{id}', [TeacherController::class, 'teacher_delete'])
        ->name('teacher.teacher_delete');
// End Teachers routes


// Subjects routes
Route::get('/subject_show', [SubjectController::class, 'subject_show'])
        ->name('subject.subject_show');

Route::get('/subject_create', [SubjectController::class, 'subject_create'])
        ->name('subject.subject_create');

Route::post('/subject_store', [SubjectController::class, 'subject_store'])
        ->name('subject.subject_store');

Route::get('/subject_edit/{id}', [SubjectController::class, 'subject_edit'])
        ->name('subject.subject_edit');

Route::post('/subject_update/{id}', [SubjectController::class, 'subject_update'])
        ->name('subject.subject_update');

Route::post('/subject_delete/{id}', [SubjectController::class, 'subject_delete'])
        ->name('subject.subject_delete');
// End Subjects routes


// Groups routes
Route::get('/group_show', [GroupController::class, 'group_show'])
    ->name('group.group_show');

Route::get('/group_create', [GroupController::class, 'group_create'])
    ->name('group.group_create');

Route::post('/group_store', [GroupController::class, 'group_store'])
    ->name('group.group_store');

Route::get('/group_edit/{id}', [GroupController::class, 'group_edit'])
    ->name('group.group_edit');

Route::post('/group_update/{id}', [GroupController::class, 'group_update'])
    ->name('group.group_update');

Route::post('/group_delete/{id}', [GroupController::class, 'group_delete'])
    ->name('group.group_delete');

Route::get('/group_archive_show', [GroupController::class, 'group_archive_show'])
    ->name('group.group_archive_show');

Route::get('/group_first_show/{id}', [GroupController::class, 'group_first_show'])
    ->name('group.group_first_show');

Route::get('/groups/{id}', [GroupController::class, 'group_first_show'])->name('group.show');
// End Groups routes


// Students routes
Route::get('/student_show', [StudentController::class, 'student_show'])
    ->name('student.student_show');

Route::get('/student_create', [StudentController::class, 'student_create'])
    ->name('student.student_create');

Route::post('/student_store', [StudentController::class, 'student_store'])
    ->name('student.student_store');

Route::get('/student_edit/{id}', [StudentController::class, 'student_edit'])
    ->name('student.student_edit');

Route::post('/student_update/{id}', [StudentController::class, 'student_update'])
    ->name('student.student_update');

Route::post('/student_delete/{id}', [StudentController::class, 'student_delete'])
    ->name('student.student_delete');

Route::get('/student_first_groups_show/{id}', [StudentController::class, 'student_first_groups_show'])
    ->name('student.student_first_groups_show');

Route::post('/student_update_group/{student_id}', [StudentController::class, 'student_update_group'])
    ->name('student.student_update_group');

Route::get('/student/search', [StudentController::class, 'search'])
    ->name('student.search');

Route::post('/student_update', [StudentController::class, 'student_update'])
    ->name('student_update');

Route::post('/student_update_payment', [StudentController::class, 'student_update_payment'])
    ->name('student_update_payment');

// End Students routes


// Attendance routes
// Route::post('/attendance/save', [AttendanceController::class, 'store'])
//     ->name('attendance_save');

Route::post('/attendance_save', [AttendanceController::class, 'attendance_save'])
    ->name('attendance_save');

Route::post('/lesson_date_update', [AttendanceController::class, 'lesson_date_update'])
    ->name('lesson_date_update');

Route::post('/group/{group}/clone-previous-month', [AttendanceController::class,'clone_previous_month'])
    ->name('group.clone_previous_month');
// End Attendance routes

// Financial routes
Route::post('/financial_save', [PaymentController::class, 'student_update_payment'])
    ->name('student_update_payment');

Route::post('/student_update_comment', [PaymentController::class, 'student_update_comment'])
    ->name('student_update_comment');
// End Financial routes

// Payment routes

