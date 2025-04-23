<?php
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome');});

// Grades
Route::get('/grades', [GradeController::class, 'index']);
Route::get('/grades/create', [GradeController::class, 'create']);
Route::post('/grades', [GradeController::class, 'store']);
Route::get('/grades/{grade}/edit', [GradeController::class, 'edit']);
Route::put('/grades/{grade}', [GradeController::class, 'update']);
Route::delete('/grades/{grade}', [GradeController::class, 'destroy']);

//Studnets
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');


//Subjects
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subjects/create', [SubjectController::class, 'create']);
Route::post('/subjects', [SubjectController::class, 'store']);
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);
Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit']);
Route::put('/subjects/{subject}', [SubjectController::class, 'update']);
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy']);

//auth
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store']);
Route::delete('/logout', [SessionController::class, 'destroy']);

//prof
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth');

