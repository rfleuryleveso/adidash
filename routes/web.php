<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\TasksController;
use App\Http\Controllers\Student\ProjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')->middleware("auth")->group(function () {
    Route::get('', [HomeController::class, 'home'])->name('student.home');
    Route::get('tasks', [TasksController::class, 'home'])->name('student.tasks');
    Route::get('projects', [ProjectsController::class, 'home'])->name('student.projects');

    Route::get('settings', [HomeController::class, 'logout'])->name('settings');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');
});
