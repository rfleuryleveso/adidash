@extends('committee.projects.project.layout')

@section('title', "Comité {$project->name}")

@section('page_name', "Comité | {$project->name}")

@section('project-content')

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Tâches du projet ({{$tasks->count()}} tâches)
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de la tâche</th>
                        <th>Statut</th>
                        <th>Statut notation</th>
                        <th>Date de début</th>
                        <th>Membres</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <th>{{$task->id}}</th>
                            <td>{{$task->name}}</td>
                            <td>
                                <x-task-status :status="$task->status"/>
                            </td>
                            <td>
                                <x-task-notation-status :status="$task->notation_status"/>
                            </td>
                            <td>{{$task->starts_at}}</td>
                            <td>{{$task->users->map(function ($member) { return $member->fullName; })->join(',')}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
