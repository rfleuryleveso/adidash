@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Gestion de projet | ' . $project->name)

@section('content')
    <div class="columns">
        <div class="column is-two-third">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Tâches
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
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th>{{ $task->name }}</th>
                                        <td>{{ $task->users->map(function ($member) {
                                                        return $member->fullName;
                                                    })->join(', ') }}</td>
                                        <td>
                                            <x-task-status :status="$task->status" />
                                        </td>
                                        <td>
                                            @if ($task->ended_at != null)
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
                        <div class="columns">
                            <div class="column">
                                {{ $tasks->links() }}
                            </div>
                            <div class="column has-text-right">
                                <a class="button is-small is-link" href="{{ route("project-admin.create-task", ['project' => $project->id]) }}"><i class="fas fa-plus mr-2"></i> Créer une nouvelle tâche</a>
                            </div>
                        </div>
                        
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Filtres
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
