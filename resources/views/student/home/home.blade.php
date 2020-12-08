@extends('layouts.app')

@section('title', 'Accueil')

@section('page_name', 'Accueil')

@section('content')
    @if(Auth::user()->classgroup()->first()->id === 1)
    <div class="notification is-warning">
        Bonjour {{Auth::user()->fullName}}, <br/>
        Vous n'avez pas encore choisi votre classe, veuillez la sélectionner dans votre profil
      </div>
    @endif
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit cupiditate quam beatae error veniam aperiam? Iste, quos, a dolorum adipisci itaque ad blanditiis corporis laudantium quam mollitia voluptate iusto ipsum?</p>
@endsection