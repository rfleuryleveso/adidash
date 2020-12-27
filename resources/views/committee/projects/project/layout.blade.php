@extends('layouts.app')

@section('title', "Comité {$project->name}")

@section('page_name', "Comité | {$project->name}")

@section('content')
    <div>
        <div class="box mb-0">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li><a href="{{ route('student.home') }}">Adidash</a></li>
                    <li><a href="{{ route('committee.home') }}">Comité de projets</a></li>
                    <li><a href="{{ route('committee.projects') }}">Projets</a></li>
                    <li class="is-active"><a href="#" aria-current="page">{{ $project->name }} (#{{ $project->id }})</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="tabs">
            <ul>
                <li @if ($tab == 'home') class="is-active" @endif
                    ><a href="{{ route('committee.project', ['project' => $project->id]) }}">Accueil</a></li>
                <li @if ($tab == 'tasks') class="is-active" @endif
                    ><a href="{{ route('committee.project_tasks', ['project' => $project->id]) }}">Tâches</a></li>
                <li @if ($tab == 'team') class="is-active" @endif
                    ><a href="{{ route('committee.project_team', ['project' => $project->id]) }}">Equipe</a></li>
            </ul>
        </div>
        @yield('project-content')

    </div>
@endsection
