<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\TasksController;
use App\Http\Controllers\Student\ProjectController;
use App\Http\Controllers\Student\MeetingController;
use App\Http\Controllers\Student\SettingsController;
use App\Http\Controllers\ProjectAdmin\ProjectAdminController;

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
    Route::group(["prefix" => "", "as" => "student."], function () {
        Route::get('', [HomeController::class, 'home'])->name('home');
        Route::resource('tasks', 'Student\TasksController');
    
        Route::get('projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('project/{project}', [ProjectController::class, 'show'])->name('project');
    });
    
    Route::resource('meetings', 'Student\MeetingController');

    Route::get('settings', [SettingsController::class, 'home'])->name('settings');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'project-admin/{project}', 'as' => 'project-admin.', 'middleware' => 'can:update,project'], function () {
        Route::get('', [ProjectAdminController::class, 'home'])->name('home');
    });
});
