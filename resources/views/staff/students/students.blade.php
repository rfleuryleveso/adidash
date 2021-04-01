@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('page_name', 'Utilisateurs')

@section('content')

    <div class="columns">
        <div class="column is-fullwidth">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Élèves
                    </p>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Classe</th>
                                <th>Détail</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->fullName }}</td>
                                    <td>{{ $user->hasClassGroup() ? $user->getClassGroups()->first()->name : 'Pas de classe' }}</td>
                                    <td>Soon</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="is-block">
                           {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
