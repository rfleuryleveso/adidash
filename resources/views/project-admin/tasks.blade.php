@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Gestion de projet | ' . $project->name)

@section('content')
    <div class="tasks-container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Tâches
                </p>
            </header>
            <div class="card-content">
                <table class="table is-fullwidth">
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
    })->join(', ') }}
                                </td>
                                <td>
                                    <x-task-status :status="$task->status" />
                                    @if ($task->status == 'WAITING_FOR_PARENT_TASK')
                                        @if ($task->parent)
                                            {{ $task->parent->name }}
                                        @else
                                            <span class="tag is-danger">Tache orpheline <i
                                                    class="fas fa-exclamation-triangle ml-1"></i></span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($task->ended_at != null)
                                        {{ $task->ended_at->toDateString() }}
                                    @endif
                                </td>
                                <td>
                                    @if ($task->ends_at)
                                        {{ $task->ends_at->toDateString() }}
                                        @if ($task->ends_at->isPast())
                                            <span class="tag is-warning">(Retard
                                                {{ $task->ends_at->shortAbsoluteDiffForHumans() }})
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td><a
                                        href="{{ route('project-admin.task', ['project' => $project->id, 'task' => $task->id]) }}"><i
                                            class="far fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="is-block">
                    {{ $tasks->links() }}
                </div>

            </div>
        </div>

        <div class="filters-add">
            <div class="card" style="overflow: visible">
                <header class="card-header">
                    <p class="card-header-title">
                        Filtres
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('project-admin.tasks', ['project' => $project->id]) }}">
                        @csrf
                        <div class="field">
                            <label class="label">Nom</label>
                            <div class="control">
                                <input class="input" value="{{ request()->input('name') }}" name="name" type="text"
                                    placeholder="Nom partiels autorisés">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Etat</label>
                            <div class="select is-multiple">
                                <select multiple name="status[]">
                                    <option @if((request()->has('status') && in_array("WAITING_FOR_PARENT_TASK",
                                        request()->input('status'))) || !request()->has('status')) selected
                                        @endif
                                        value="WAITING_FOR_PARENT_TASK">En attente du parent</option>
                                    <option @if((request()->has('status') && in_array("WAITING",
                                        request()->input('status'))) || !request()->has('status')) selected
                                        @endif
                                        value="WAITING">En attente</option>
                                    <option @if((request()->has('status') && in_array("STARTED",
                                        request()->input('status'))) || !request()->has('status')) selected
                                        @endif
                                        value="STARTED">Commencé</option>
                                    <option @if((request()->has('status') && in_array("FINISHED",
                                        request()->input('status'))) || !request()->has('status')) selected
                                        @endif
                                        value="FINISHED">Fini</option>
                                    <option @if((request()->has('status') && in_array("CANCELLED",
                                        request()->input('status'))) || !request()->has('status')) selected
                                        @endif
                                        value="CANCELLED">Annulé</option>
                                </select>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-link">Chercher</button>
                            </div>
                            <div class="control">
                                <a href="{{ route('project-admin.tasks', ['project' => $project->id]) }}"
                                    class="button is-link is-light">Vider</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <a class="submit-button " href="{{ route('project-admin.create-task', ['project' => $project->id]) }}"><i
                    class="fas fa-plus mr-2"></i> <span>Créer une nouvelle tâche</span></a>

        </div>
    </div>
    </div>
@endsection
