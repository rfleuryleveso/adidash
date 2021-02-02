<?php

use App\Http\Controllers\Committee\CommitteeController;
use App\Http\Controllers\Committee\ProjectController as CommitteeProjectController;
use App\Http\Controllers\Committee\TagsController as CommitteeTagsController;
use App\Http\Controllers\Committee\UserController as CommitteeUserController;
use App\Http\Controllers\ProjectAdmin\ProjectAdminController;
use App\Http\Controllers\ProjectAdmin\TasksController as ProjectTasksController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Student\DeliverableController as StudentDeliverableController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\ProjectController;
use App\Http\Controllers\Student\TasksController as StudentTasksController;
use Illuminate\Support\Facades\Route;

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

        Route::get('projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('project/{project}', [ProjectController::class, 'show'])->name('project');

        Route::group(["prefix" => "tasks", "as" => "tasks."], function () {
            Route::get('', [StudentTasksController::class, 'index'])->name('index');
            Route::get('{task}', [StudentTasksController::class, 'show'])->name('task');

            Route::get('{task}/join', [StudentTasksController::class, 'join'])->name('task.join');
            Route::get('{task}/leave', [StudentTasksController::class, 'leave'])->name('task.leave');

            Route::post('{task}/set-status', [StudentTasksController::class, 'setStatus'])->name('task.set-status');
        });

        Route::group(["prefix" => "deliverables", "as" => "deliverable."], function () {
            Route::post('', [StudentDeliverableController::class, 'store'])->name('store');
            Route::post('{deliverable}/add-user', [StudentDeliverableController::class, 'addUserToDeliverable'])->name('add-user');
            Route::post('{deliverable}/remove-user', [StudentDeliverableController::class, 'removeUserFromDeliverable'])->name('remove-user');
            Route::delete('{deliverable}', [StudentDeliverableController::class, 'destory'])->name('destroy');
        });
    });

    Route::resource('meetings', 'Student\MeetingController');

    Route::get('settings', [SettingsController::class, 'home'])->name('settings');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('tags', [HomeController::class, 'tags'])->name('tags');

    Route::get('logout', [HomeController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'project-admin/{project}', 'as' => 'project-admin.', 'middleware' => 'can:update,project'], function () {
        Route::get('', [ProjectAdminController::class, 'home'])->name('home');
        Route::post('update', [ProjectAdminController::class, 'update'])->name('update');
        Route::match(['GET', 'POST'], 'tasks', [ProjectTasksController::class, 'home'])->name('tasks');
        Route::get('tasks/{task}', [ProjectTasksController::class, 'task'])->name('task');
        Route::post('tasks/{task}/grades', [ProjectTasksController::class, 'taskUpdateNotation'])->name('task.update-grades');

        Route::view('create-task', 'project-admin.create-task')->name('create-task');
        Route::post('create-task', [ProjectTasksController::class, 'create'])->name('create-task');
    });

    Route::group(['prefix' => 'committee', 'as' => 'committee.',  'middleware' => 'can:access-committee'], function () {
        Route::get('', [CommitteeController::class, 'home'])->name('home');

        Route::get('tags', [CommitteeTagsController::class, 'list'])->name('tags.list');
        Route::post('tags', [CommitteeTagsController::class, 'create'])->name('tags.create');
        Route::get('tags/{tag}/delete', [CommitteeTagsController::class, 'delete'])->name('tags.delete');

        Route::get('users', [CommitteeUserController::class, 'users'])->name('users');
        Route::get('users/{user}', [CommitteeUserController::class, 'user'])->name('user')->middleware('can:view,user');

        Route::get('projects', [CommitteeProjectController::class, 'projects'])->name('projects');
        Route::view('project/create', 'committee.projects.create-project')->name('create-project');
        Route::post('project/create', [CommitteeProjectController::class, 'createProject'])->name('create-project');

        Route::get('project/{project}', [CommitteeProjectController::class, 'project'])->name('project');
        Route::get('project/{project}/tasks', [CommitteeProjectController::class, 'project_tasks'])->name('project_tasks');
        Route::get('project/{project}/team', [CommitteeProjectController::class, 'project_team'])->name('project_team');

        Route::get('groups', [CommitteeController::class, 'groups'])->name('groups');
    });
});
