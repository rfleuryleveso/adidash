@extends('layouts.app')

@section('title', 'Administration d\'année')

@section('page_name', 'Administration d\'année | Gestion des groupes')

@section('content')
    <div class="box">
        Cette page permet de gérer les utilisateurs.
    </div>
    <div class="users box">
        <table class="table is-fullwidth">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Détail</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>@if($user->deleted_at) <i class="fas fa-trash"></i> @endif {{$user->id}}</td>
                    <td>{{ $user->fullName }}</td>
                    <td>{{ $user->hasClassGroup() ? $user->getClassGroups()->first()->name : 'Pas de classe' }}</td>
                    <td><a href="{{route('administration.users.user.edit', ['userWithDeleted' => $user->id])}}"><i
                                class="fas fa-edit"></i> Editer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
    <a class="button is-link" href="{{route('administration.users.create')}}"> Créer un nouvel utilisateur</a>

@endsection
