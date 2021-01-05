<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task as TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('student.tasks.tasks');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Task $task) {
		if ($request->ajax()) {
			return new TaskResource($task);
		}
		return view("student.tasks.task", ["task" => $task]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Task $task) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Task $task) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Task $task) {
		//
	}
}
