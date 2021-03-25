<?php

namespace App\Http\Controllers\ProjectAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectAdminSearchTasks;
use App\Http\Requests\ProjectAdminUpdateNotation;
use App\Http\Requests\ProjectCreateTask;
use App\Http\Resources\Task as TaskResource;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use Auth;

class TasksController extends Controller
{
    public function home(ProjectAdminSearchTasks $request, Project $project)
    {
        $tasksQuery = $project->tasks()->withoutGlobalScopes();
        if ($request->ajax()) {
            return TaskResource::collection($tasksQuery->whereNotIn('status', ['FINISHED', 'CANCELLED'])->get());
        }
        if ($request->isMethod('post')) {
            if ($request->has('status')) {
                $tasksQuery->whereIn('status', $request->input('status'));
            }
            if ($request->has('name')) {
                $tasksQuery->where('name', 'LIKE', '%' . $request->input('name') . '%');
            }
        }
        $tasks = $tasksQuery->paginate(10);
        return view('project-admin.tasks', ['project' => $project, 'tasks' => $tasks]);
    }


    public function create(ProjectCreateTask $request)
    {
        $task = new Task;

        $task->project_id = $request->route('project')->id;
        $task->fill($request->validated());
        $task->status = (!!$request->parent_task) ? "WAITING_FOR_PARENT_TASK" : "WAITING";
        $task->save();

        if ($request->tags) {
            foreach ($request->tags as $tagId) {
                $tag = Tag::find($tagId);
                $task->tags()->attach($tag);
            }
        }
        return redirect()->route('project-admin.tasks', ['project' => $task->project_id]);
    }

    public function task(Project $project, Task $task)
    {
        $grades = $task->grades;
        $canChangeGrades = $task->notation_status == "WAITING_FOR_CHIEF";
        return view('project-admin.task', ['project' => $project, 'task' => $task, 'grades' => $grades, 'canChangeGrades' => $canChangeGrades]);
    }

    public function taskUpdateNotation(ProjectAdminUpdateNotation $request)
    {
        foreach ($request->grades as $grade) {
            Grade::updateOrCreate(
                ['task_id' => $request->task->id, 'user_id' => $grade['user'], 'evaluation_type' => 'PROJETCHIEF'],
                ['grade' => $grade['grade'], 'evaluator_id' => Auth::id(), 'comments' => $grade['comments']]
            );
        }
        $task = $request->task;

        if ($request->has('notation_finished') && $request->get('notation_finished') === "on") {
            $task->notation_status = "WAITING_FOR_STAFF";
        } else {
            $task->notation_status = "WAITING_FOR_CHIEF";
        }

        $task->save();

        return redirect()->back()->with('success', 'Notes mises à jour');
    }

    public function update(ProjectCreateTask $request)
    {
        $request->task->update($request->validated());
        return redirect()->back()->with('success', 'Tâche mise à jour');
    }

}
