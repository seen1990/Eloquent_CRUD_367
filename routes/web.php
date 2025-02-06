<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// แสดงรายการ นศ.
Route::get('/students', [StudentsController::class, 'index'])->name('student.index');

// หน้าแบบฟอร์มสำหรับเพิ่มข้อมูล นศ.
Route::get('/students/create', [StudentsController::class, 'create'])
->name('student.create');

// Function สำหรับบันทึกข้อมูล นศ.
Route::post('/students', [StudentsController::class, 'store']) 
->name('student.store');

//หน้าแก้ไขข้อมูล
Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])
->name('student.edit');

//Function สำหรับแก้ไขข้อมูล นศ.
Route::put('/students/{student}', [StudentsController::class, 'update'])
->name('student.update');

//ลบข้อมูล นศ.
Route::delete('/students/{student}', [StudentsController::class, 'destroy'])
->name('student.destroy');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
