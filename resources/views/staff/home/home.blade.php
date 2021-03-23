@extends('layouts.app')

@section('title', 'Accueil')

@section('page_name', 'Accueil')

@section('content')
    @if(!Auth::user()->hasStaffGroup())
    <div class="notification is-warning">
        Bonjour {{Auth::user()->fullName}}, <br/>
        Merci de confirmer votre profil auprès de l'administrateur.
    </div>
    @endif

    <div class="notification is-info">
        <p>{{$tasksAwaitingNotation->count() }} tâche(s) en attente de notation</p>
    </div>

    <div class="notification is-info">
        <p>{{$projectAwaitingNotation->count() }} projet(s) en attente de notation</p>
    </div>

   @endsection