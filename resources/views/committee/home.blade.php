@extends('layouts.app')

@section('title', 'Comité de projets')

@section('page_name', 'Comité de projets')

@section('content')
    <div>
        Utilisateurs: {{$users->count()}}<br/>
        Projects: {{$projects->count()}}
    </div>
@endsection