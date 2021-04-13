@extends('layouts.app')

@section('title', 'Accueil')

@section('page_name', 'Accueil')

@section('content')
    <div class="columns">
        <div class="column is-one-fifth">
            <div class="card has-background-link has-text-white">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5 m-0">
                                Tâches
                            </p>
                            <p class="is-size-7 m-0">
                                En attente de notation
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">{{$tasksAwaitingNotation->count() }}</p>
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
                                En attente de notation
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">{{$projectAwaitingNotation->count() }}</p>
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
                                Projets
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $projects->count() }}
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
                                Tâches
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $tasks->count() }}
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
                                Utilisateurs
                            </p>
                            <p class="is-size-7 m-0">
                                Total
                            </p>
                        </div>
                        <div class="column">
                            <p class="is-size-3 has-text-right">
                                {{ $users->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
