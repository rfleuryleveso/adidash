@extends('layouts.app')

@section('title', 'Tâches')

@section('page_name', 'Tâches')

@section('content')

    @if(!Auth::user()->hasStaffGroup())
    <div class="notification is-warning">
        Bonjour {{Auth::user()->fullName}}, <br/>
        Merci de confirmer votre profil auprès de l'administrateur.
    </div>
    @endif

    @foreach ($tasksAwaitingNotation as $task)
        <div class="notification is-info">
            <p>Nom de la tâche : {{$task->name}}</p>
            <p>Decription de la tâche : {{$task->description}}</p>
        </div>
    @endforeach

@endsection