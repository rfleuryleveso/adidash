@extends('layouts.app')

@section('title', 'Tâches')

@section('page_name', 'Tâches')

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
                    <table class="table is-fullwidth">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Projet</th>
                            <th>Equipe</th>
                            <th>Statut notation</th>
                            <th>Fin</th>
                            <th>Détail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <th>{{ $task->name }}</th>
                                <th>{{ $task->project->name }}</th>
                                <td>{{ $task->users->map(function ($member) {
                                                return $member->fullName;
                                            })->join(', ') }}</td>
                                <td>
                                    @if ($task->notation_status == 'WAITING_FOR_CHIEF')
                                        <span class="tag is-primary">En attente du chef de projet</span>
                                    @elseif($task->notation_status == 'WAITING_FOR_STAFF')
                                        <span class="tag is-info">En attente du staff</span>
                                    @else
                                        <span class="tag is-black">Fini</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($task->ended_at != null)
                                        {{ $task->ended_at->toDateString() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('staff.tasks.task', ['task' => $task->id])}}"><i
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
        </div>
        <div class="column is-one-third">
            <div class="card" style="overflow: visible">
                <header class="card-header">
                    <p class="card-header-title">
                        Filtres
                    </p>
                </header>
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('staff.tasks.home') }}">
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
                                    <option
                                        @if((request()->has('status') && in_array("WAITING_FOR_PARENT_TASK", request()->input('status'))) || !request()->has('status')) selected
                                        @endif value="WAITING_FOR_PARENT_TASK">En attente du parent
                                    </option>
                                    <option
                                        @if((request()->has('status') && in_array("WAITING", request()->input('status'))) || !request()->has('status')) selected
                                        @endif value="WAITING">En attente
                                    </option>
                                    <option
                                        @if((request()->has('status') && in_array("STARTED", request()->input('status'))) || !request()->has('status')) selected
                                        @endif value="STARTED">Commencé
                                    </option>
                                    <option
                                        @if((request()->has('status') && in_array("FINISHED", request()->input('status'))) || !request()->has('status')) selected
                                        @endif value="FINISHED">Fini
                                    </option>
                                    <option
                                        @if((request()->has('status') && in_array("CANCELLED", request()->input('status'))) || !request()->has('status')) selected
                                        @endif value="CANCELLED">Annulé
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Statut notation</label>
                            <div class="select is-multiple">
                                <select multiple name="notation_status[]">
                                    <option
                                        @if((request()->has('notation_status') && in_array("WAITING_FOR_CHIEF", request()->input('notation_status')))) selected
                                        @endif value="WAITING_FOR_CHIEF">En attente du chef de projet
                                    </option>
                                    <option
                                        @if((request()->has('notation_status') && in_array("WAITING_FOR_STAFF", request()->input('notation_status'))) || !request()->has('notation_status')) selected
                                        @endif value="WAITING_FOR_STAFF">En attente du staff
                                    </option>
                                    <option
                                        @if((request()->has('notation_status') && in_array("FINISHED", request()->input('notation_status'))) ) selected
                                        @endif value="FINISHED">Fini
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Project</label>
                            <div class="select is-multiple">
                                <select multiple name="projects[]">
                                    @foreach($projects as $project)
                                        <option
                                            @if((request()->has('projects') && in_array($project->id, request()->input('projects'))  || !request()->has('projects') ) ) selected
                                            @endif value="{{$project->id}}">{{$project->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-link">Chercher</button>
                            </div>
                            <div class="control">
                                <a href="{{ route('staff.tasks.home') }}"
                                   class="button is-link is-light">Vider</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
