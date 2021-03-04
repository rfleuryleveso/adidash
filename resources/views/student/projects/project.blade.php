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
                    <x-markdown :content="$project->description || '' "/>
                    <hr/>
                    <p>
                        Début du projet: @if ($project->start_date)
                            {{ $project->start_date->toFormattedDateString() }} @else Inconnu
                        @endif
                        <br/>
                        Deadline: @if ($project->end_date)
                            {{ $project->end_date->toFormattedDateString() }} @else Inconnu
                        @endif
                        <br/>
                        Chef(s) de projet: {{ $project->members()->wherePivot('relation_type', 3)->get()->map(function ($user) {
                                    return $user->fullName;
                                })->join(', ') }}
                    </p>
                    <hr/>
                    @if(!$project->members->contains(Auth::user()))
                        @if($project->allow_new_member)
                            <a class="button is-info" href="{{route('student.projects.project.join', ['project' => $project->id])}}">Rejoindre le projet</a>
                        @else
                            Ce projet n'accepte pas de nouveaux membres
                        @endif
                    @else
                        <a class="button is-warning"  href="{{route('student.projects.project.leave', ['project' => $project->id])}}">Quitter le projet</a>
                    @endif
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
                                        @foreach ($task->tags as $tag)
                                            <x-task-tag :tag="$tag"/>
                                        @endforeach
                                    </td>
                                    <td>
                                        <x-task-status :status="$task->status"/>
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
                                            Inconnu
                                        @endif
                                    </td>
                                    <td><a href="{{ route('student.tasks.task', ['task' => $task->id]) }}"
                                           data-dashrole="taskModal" data-task="{{ $task->id }}"><i
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

@push('scripts')
    <script>
        Array.from(document.querySelectorAll('a[data-dashrole="taskModal"]')).forEach(el => {
            el.addEventListener("click", (event) => {
                return 2 === event.which || event.metaKey || event.ctrlKey ? true : (() => {
                    event.preventDefault();
                    openTaskModal(parseInt(el.dataset.task, 10))
                })();
            });
        })

    </script>

@endpush
