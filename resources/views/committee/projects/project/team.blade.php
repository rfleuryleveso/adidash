@extends('committee.projects.project.layout')

@section('title', "Comité {$project->name}")

@section('page_name', "Comité | {$project->name}")

@section('project-content')

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Equipe du projet ({{$members->count()}} membre)
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Classe</th>
                        <th>Rang</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <th>{{$member->id}}</th>
                            <td>{{$member->fullName}}</td>
                            <td>{{$member->hasClassGroup() ? $member->getClassGroups()->first()->name : ''}}</td>
                            <td>
                                <x-project-user-relation :relation="$member->pivot->relation_type"/>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
