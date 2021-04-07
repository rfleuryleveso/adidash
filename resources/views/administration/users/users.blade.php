@extends('layouts.app')

@section('title', 'Administration d\'année')

@section('page_name', 'Administration d\'année | Gestion des groupes')

@section('content')
    <div class="box">
        Cette page permet de gérer les utilisateurs.
    </div>
    <div class="groups box">
        <div class="columns">
            <div class="column">
                #
            </div>
            <div class="column">
                Nom
            </div>
            <div class="column">
                Classe
            </div>
            <div class="column">
                Actions
            </div>
        </div>
        @foreach($users as $user)
            <div class="group parent-group">
                <div class="columns">
                    <div class="column is-2">
                        {{$user->id}}
                    </div>
                    <div class="column">
                        {{$user->fullName}}
                    </div>
                    <div class="column">
                        {{$user->hasClassGroup() ? $user->getClassGroups()->first()->name : ""}}
                        {{$user->hasCommitteeGroup() ? $user->getCommitteeGroups()->first()->name : ""}}
                        {{$user->hasStaffGroup() ? $user->getStaffGroups()->first()->name : ""}}
                    </div>
                    <div class="column">
                        <a href="{{route('administration.users.user.edit', ['user' => $user->id])}}"><i
                                class="fas fa-edit"></i> Editer</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
