@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Gestion de projet | ' . $project->name)

@section('content')
    <div class="columns">
        <div class="column is-two-third">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Tâches de la semaine
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Equipe</th>
                                        <th>Statut</th>
                                        <th>Fin</th>
                                        <th>Fin attendue</th>
                                        <th>Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($week_tasks as $task)
                                        <tr>
                                            <th>{{ $task->name }}</th>
                                            <td>{{ $task->users->map(function ($member) {
                                                        return $member->fullName;
                                                    })->join(', ') }}</td>
                                            <td>
                                                <x-task-status :status="$task->status" />
                                            </td>
                                            <td>
                                                @if($task->ended_at != null)
                                                    {{ $task->ended_at->toDateString() }}
                                                @endif
                                            </td>
                                            <td>

                                                {{ $task->ends_at->toDateString() }}
                                                @if ($task->ends_at->isPast())
                                                    <span class="tag is-warning">(Retard
                                                        {{ $task->ends_at->shortAbsoluteDiffForHumans() }})
                                                    </span>
                                                @endif

                                            </td>
                                            <td><a href=""><i class="far fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="column">
                <div class="card has-background-link has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-users"></i> Membres
                                </p>
                                <p class="is-size-7 m-0">
                                    Avec une tâche
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->members->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-info has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-tasks"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    Total
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->tasks->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-primary has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-briefcase"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En cours
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'STARTED')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-success has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-check"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    Finies
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'FINISHED')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-warning has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-hourglass"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En retard
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'STARTED')->whereDate('ends_at', '<', \Carbon\Carbon::now())->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
