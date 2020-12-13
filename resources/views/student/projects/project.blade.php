@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Projet | ' . $project->name)

@section('content')
    <div class="columns is-desktop">
        <div class="column is-one-third-desktop">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Projet {{ $project->name }}
                    </p>
                </header>
                <div class="card-content project-description">
                    @php
                    $Parsedown = new \Parsedown();
                    echo $Parsedown->setBreaksEnabled(true)->text($project->description);
                    @endphp
                    <hr />
                    <p>
                        Début du projet: {{ $project->start_date->toFormattedDateString() }}<br />
                        Deadline: {{ $project->end_date->toFormattedDateString() }}<br />
                        Chef(s) de projet: {{ $project->members()->wherePivot('relation_type', 3)->get()->map(function ($user) {
                                    return $user->fullName;
                                })->join(', ') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="column is-two-third-desktop">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Tâches disponibles
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Equipe</th>
                                    <th>Tags</th>
                                    <th>Statut</th>
                                    <th>Fin</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($available_tasks as $task)
                                    <tr>
                                        <th>{{ $task->name }}</th>
                                        <td>{{ $task->users->map(function ($member) {
                                                    return $member->fullName;
                                                })->join(', ') }}</td>
                                        <td>
                                            Electronique, Programmation
                                        </td>
                                        <td>
                                            <x-task-status :status="$task->status" />
                                        </td>
                                        <td>
                                            @if ($task->ends_at)
                                                {{ $task->ends_at->toDateString() }}
                                                @if ($task->ends_at->isPast())
                                                    <span class="tag is-warning">(Retard
                                                        {{ $task->ends_at->shortAbsoluteDiffForHumans() }})
                                                    </span>
                                                @endif
                                            @else
                                                ?
                                            @endif
                                        </td>
                                        <td><a href="#" onclick="openTaskModal({{ $task->id }})"><i
                                                    class="far fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
