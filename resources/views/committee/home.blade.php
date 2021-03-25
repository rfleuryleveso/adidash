@extends('layouts.app')

@section('title', 'Comité de projets')

@section('page_name', 'Comité de projets')

@section('content')
    <div class="content-container">
        <div>
            Utilisateurs: {{ $users->count() }}<br />
            Projects: {{ $projects->count() }}
        </div>
    </div>
@endsection
