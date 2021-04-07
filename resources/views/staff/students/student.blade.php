@extends('layouts.app')

@section('title', "Administration {$user->fullName}")

@section('page_name', "Administration | {$user->fullName}")

@section('content')
    <div class="content-container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    {{$user->fullName}}
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Chef de projets sur:</th>
                            <td>{{$user->ownedProjects()->get()->pluck('name')->join(', ')}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <header class="card-header">
                <p class="card-header-title">
                    Tâches par semaine
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <header class="card-header">
                <p class="card-header-title">
                    Liste des projets
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom du projet</th>
                            <th>Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <th>{{$project->name}}</th>
                                <td>
                                    <x-project-user-relation :relation="$project->pivot->relation_type"/>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <header class="card-header">
                <p class="card-header-title">
                    Liste des tâches
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom de la tâche</th>
                            <th>Nom du projet</th>
                            <th>Etat de la tâche</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->name}}</td>
                                <td>
                                    {{$task->project->name}}
                                </td>
                                <td>
                                    <x-task-status :status="$task->status"/>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($tasksPerWeekLabels),
                datasets: [{
                    label: 'Nombre de tâches par semaine',
                    data: @json($tasksPerWeekValues),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
