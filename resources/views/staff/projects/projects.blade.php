@extends('layouts.app')

@section('title', 'Projets')

@section('page_name', 'Projets')

@section('content')

    <div class="columns">
        <div class="column is-fullwidth">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Projets
                    </p>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Chefs de projet</th>
                            <th>Classe liées</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->admins->map(function ($user) {
                                    return $user->fullName;
                                })->join(', ') }}</td>
                                <td>{{ $project->groups->map(function ($group) {
                                    return $group->name;
                                })->join(', ') }}</td>
                                <td><a href="{{route('staff.projects.project', ['project' => $project->id])}}"><i class="fas fa-eye"></i> </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
