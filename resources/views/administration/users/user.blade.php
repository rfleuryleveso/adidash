@extends('layouts.app')

@section('title', "Administration {$user->fullName}")

@section('page_name', "Administration | {$user->fullName}")

@section('content')
    <div class="content-container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    {{$user->fullName}}
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Prénom</th>
                            <td>{{$user->first_name}}</td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td>{{$user->last_name}}</td>
                        </tr>
                        <tr>
                            <th>Possède un groupe de classe</th>
                            <td>{{$user->hasClassGroup() ? 'Oui, ' : 'Non'}} {{$user->hasClassGroup() ? $user->getClassGroups()->first()->name : ''}}</td>
                        </tr>
                        <tr>
                            <th>Possède un groupe de comité</th>
                            <td>{{$user->hasCommitteeGroup() ? 'Oui, ' : 'Non'}} {{$user->hasCommitteeGroup() ? $user->getCommitteeGroups()->first()->name : ''}}</td>
                        </tr>
                        <tr>
                            <th>Possède un groupe de staff</th>
                            <td>{{$user->hasStaffGroup() ? 'Oui, ' : 'Non'}} {{$user->hasStaffGroup() ? $user->getStaffGroups()->first()->name : ''}}</td>
                        </tr>
                        <tr>
                            <th>Possède un groupe d'administration</th>
                            <td>{{$user->hasAdministrationGroup() ? 'Oui, ' : 'Non'}} {{$user->hasAdministrationGroup() ? $user->getAdministrationGroups()->first()->name : ''}}</td>
                        </tr>
                        <tr>
                            <th>Est-il administrateur ?</th>
                            <td>{{$user->isAdministrator() ? 'Oui' : 'Non'}}</td>
                        </tr>
                        <tr>
                            <th>Nombre de tâches</th>
                            <td>{{$user->tasks()->count()}}</td>
                        </tr>
                        <tr>
                            <th>Nombre de notes</th>
                            <td>{{$user->grades()->count()}}</td>
                        </tr>
                        <tr>
                            <th>Nombre de projets</th>
                            <td>{{$user->projects()->count()}}</td>
                        </tr>
                        <tr>
                            <th>Chef de projets sur: </th>
                            <td>{{$user->ownedProjects()->get()->pluck('name')->join(', ')}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
