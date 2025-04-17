<?php
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome');});

//Grades
Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');

//Studnets
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{student}', [StudentController::class, 'show']);
Route::get('/students/{student}/edit', [StudentController::class, 'edit']);
Route::put('/students/{student}', [StudentController::class, 'update']);
Route::delete('/students/{student}', [StudentController::class, 'destroy']);

//Subjects
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subjects/create', [SubjectController::class, 'create']);
Route::post('/subjects', [SubjectController::class, 'store']);
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);
Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit']);
Route::put('/subjects/{subject}', [SubjectController::class, 'update']);
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy']);