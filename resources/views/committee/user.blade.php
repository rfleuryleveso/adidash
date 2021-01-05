@extends('layouts.app')

@section('title', "Comité {$user->fullName}")

@section('page_name', "Comité | {$user->fullName}")

@section('content')
    <div>
        <div class="box">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li><a href="{{ route('student.home') }}">Adidash</a></li>
                    <li><a href="{{ route('committee.home') }}">Comité de projets</a></li>
                    <li><a href="{{ route('committee.users') }}">Utilisateurs</a></li>
                    <li class="is-active"><a href="#" aria-current="page">{{ $user->fullName }} (#{{ $user->id }})</a></li>
                </ul>
            </nav>
        </div>
        <div class="box">
            Utilisateur: {{ $user->fullName }}<br />
            Email: {{ $user->email }}
        </div>
    </div>
@endsection
