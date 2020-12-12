@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Gestion de projet | ' . $project->name)

@section('content')
    <div class="columns">
        <div class="column is-two-third">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Tâches en cours
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Equipe</th>
                                        <th>Statut</th>
                                        <th>Fin</th>
                                        <th>Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Finir la stabilisation</th>
                                        <td>Robin Lecouffe</td>
                                        <td><span class="tag is-primary">En cours</span></td>
                                        <td>11-12-2020  <span class="tag is-warning">(Retard 1j)</span></td>
                                        <td><a href=""><i class="far fa-eye"></i></a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="column">
                <div class="card has-background-link has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-users"></i> Membres
                                </p>
                                <p class="is-size-7 m-0">
                                    Avec une tâche
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->members->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-info has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-tasks"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    Total
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->tasks->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-primary has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-briefcase"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En cours
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->tasks()->where('status', 'STARTED')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-success has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-check"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    Finies
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->tasks()->where('status', 'FINISHED')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card has-background-warning has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    <i class="fas fa-hourglass"></i> Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En retard
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">{{ $project->tasks()->where('status', 'STARTED')->where('ends_at', '<', 'GETDATE()')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
