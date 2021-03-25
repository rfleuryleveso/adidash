@extends('layouts.app')

@section('title', 'Membres')

@section('page_name', 'Comité de projets | Membres')

@section('content')
    <div class="content-container commitee">
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td><a href="{{ route('committee.user', ['user' => $user->id]) }}"><i class="far fa-eye" /></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
