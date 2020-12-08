@extends('layouts.app')

@section('title', 'Page Title')

@section('page_name', 'Tâches')

@section('content')
    <section>
        <h2>Mes tâches</h2>
        <div class="element-task">
            <div class="task-text">
                <h1 class="task-title">Titre de la tâche</h1>
                <h2 class="task-description">Description de la tâche</h2>
                <p>deadline</p>
            </div>

            <div class="task-button">
                <a href="#"></a>
            </div>
        </div>
    </section>
    <section>
        <h2>Tâches disponibles</h2>
    </section>

    </main>

@endsection
    