<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminTaskController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::get('/', function () {
    return redirect('/tasks');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin-tasks', AdminTaskController::class);
});

Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

