@extends('layouts.app')

@section('title', 'Projets')

@section('page_name', 'Projets')

@section('content')
    <div class="box content-container commitee-projects">
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Intro</th>
                    <th>Statut</th>
                    <th>Chefs de projet</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th>{{ $project->id }}</th>
                        <td>{{ $project->name }}</td>
                        <th>{{ $project->intro }}</th>
                        <th>{{ $project->status }}</th>
                        <td>
                            @foreach ($project
            ->members()
            ->wherePivot('relation_type', '3')
            ->get()
        as $member)
                                <a
                                    href={{ route('committee.user', ['user' => $member->id]) }}>{{ $member->fullName }}</a>
                            @endforeach
                        </td>
                        <td><a href="{{ route('committee.project', ['project' => $project->id]) }}"><i
                                    class="far fa-eye" /></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="button is-small is-link" href="{{ route('committee.create-project') }}"><i class="fas fa-plus mr-2"></i>
            Créer un nouveau projet </a>
    </div>
@endsection
