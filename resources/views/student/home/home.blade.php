@extends('layouts.app')

@section('title', 'Page Title')

@section('page_name', 'Accueil')

@section('content')
    @if(Auth::user()->classgroup()->first()->id === 1)
    <div class="notification is-warning">
        Bonjour {{Auth::user()->fullName}}, <br/>
        Vous n'avez pas encore choisi votre classe, veuillez la sélectionner dans votre profil
      </div>
    @endif
    <p>This is my body content.</p>
@endsection