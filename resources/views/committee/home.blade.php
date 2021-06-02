@extends('layouts.app')

@section('title', 'Comité de projets')

@section('page_name', 'Comité de projets')

@section('content')
    <div class="content-container">
        <div>
            <div class="columns">
                <div class="column is-one-third">
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
                                    <p class="is-size-3 has-text-right">{{ $users }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-one-third">
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
                                    <p class="is-size-3 has-text-right">{{ $projects->count()  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
