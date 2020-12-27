@extends('committee.projects.project.layout')

@section('title', "Comité {$project->name}")

@section('page_name', "Comité | {$project->name}")

@section('project-content')
    <div>
        <div class="columns">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Projet {{ $project->name }}
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Nom: {{ $project->name }}<br />
                            Chefs de projet: @foreach ($project
            ->members()
            ->wherePivot('relation_type', '3')
            ->get()
        as $member)
                                <a href={{ route('committee.user', ['user' => $member->id]) }}>{{ $member->fullName }}</a>
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
                                    @foreach ($team as $user)
                                        <tr>
                                            <th>{{ $user->id }}</th>
                                            <td>{{ $user->fullName }}</td>
                                            <td><x-project-user-relation :relation="$user->pivot->relation_type" /></td>
                                            <td><a href="{{ route('committee.user', ['user' => $user->id]) }}"><i
                                                        class="far fa-eye" /></a></td>
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
