@extends('layouts.app')

@section('title', 'Page Title')

@section('page_name', 'Tâches')

@section('content')
    <div class="student-tasks-container">
        <section class="tasks-list">
            <div class="tasks-title-row no-select" id="my-tasks-title">
                <i class="fas fa-chevron-right rotate-back" id="my-tasks-chevron"></i>
                <h2 class="task-section-title">Mes tâches</h2>
            </div>
            <ul class="element-task" id="my-tasks-list">
                @foreach ($userTasks as $task)
                    @include('student.tasks.tasksListTask', ['task' => $task])
                @endforeach
            </ul>
        </section>

        <section class="tasks-list">
            <div class="tasks-title-row" id="available-tasks-title">
                <i class="fas fa-chevron-right rotate-back" id="available-tasks-chevron"></i>
                <h2 class="task-section-title no-select">Tâches disponibles sur les projets sur lesquels vous êtes membre
                </h2>
            </div>
            <ul class="element-task" id="available-tasks-list">
                @foreach ($memberProjectsTasks as $task)
                    @include('student.tasks.tasksListTask', ['task' => $task])
                @endforeach
            </ul>
        </section>
    </div>
    </main>

@endsection

@push('scripts')
    <script src="/dist/js/tasks.js"></script>
@endpush
