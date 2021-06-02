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
    <div class="columns">
        <div class="column is-one-fifth">
            <div class="card has-background-link has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Utilisateurs
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">{{$users }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-fifth">
            <div class="card has-background-info has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Projets
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">{{ $projects  }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-fifth">
            <div class="card has-background-primary has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Tâches
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $tasks }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-fifth">
            <div class="card has-background-success has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Notes
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $grades }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-fifth">
            <div class="card has-background-warning has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Livrables
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $deliverables }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
