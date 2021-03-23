@extends('layouts.app')

@section('title', 'Administration d\'année')

@section('page_name', 'Administration d\'année | Accueil')

@section('content')
    <div class="box">
        Vous êtes administrateur.<br/>
        Ce rôle vous permet de gérer les groupes, les projets, de voir les journaux d'erreur, et les paramètres de site.<br/>
        NB: Ce rôle ne vous permet pas de toucher aux notes. Seul le staff peut le faire.<br/>
        Attention, toutes vos actions sont enregistrées et sont rendues visibles au staff.<br/>
        Veuillez vous réferrer au manuel.
    </div>
@endsection
