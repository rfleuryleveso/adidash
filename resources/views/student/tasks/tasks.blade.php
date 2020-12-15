@extends('layouts.app')

@section('title', 'Page Title')

@section('page_name', 'Tâches')

@section('content')
    <section>
        <div class="element-task">
            <div class="task-text">
                <h2 class="task-title">Titre de la tâche</h2>
                <p class="task-description">Description de la tâche</p>
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
