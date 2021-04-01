@extends('layouts.app')

@section('title', "Comité {$project->name}")

@section('page_name', "Comité | {$project->name}")

@section('content')
    <div>
        <div class="columns is-multiline">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Projet {{ $project->name }}
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Nom: {{ $project->name }}<br/>
                            Chefs de projet: @foreach ($project
            ->members()
            ->wherePivot('relation_type', '3')
            ->get()
        as $member)
                                <a href={{ route('staff.students.student', ['user' => $member->id]) }}>{{ $member->fullName }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Membres de l'équipe
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table is-fullwidth">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Lien</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th>{{ $user->id }}</th>
                                        <td>{{ $user->fullName }}</td>
                                        <td>
                                            <x-project-user-relation :relation="$user->pivot->relation_type"/>
                                        </td>
                                        <td><a href="{{ route('staff.students.student', ['user' => $user->id]) }}"><i
                                                    class="far fa-eye"/></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-full ">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Tâches
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table is-fullwidth">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Statut</th>
                                    <th>Statut notation</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th>{{ $task->id }}</th>
                                        <td>{{ $task->name }}</td>
                                        <td>
                                            <x-task-status :status="$task->status"/>
                                        </td>
                                        <td>
                                            <x-task-notation-status :status="$task->notation_status"/>
                                        </td>
                                        <td><a href="{{ route('staff.tasks.task', ['task' => $task->id]) }}"><i
                                                    class="far fa-eye"/></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
