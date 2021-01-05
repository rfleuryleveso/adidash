@extends('layouts.app')

@section('title', 'Page Title')

@section('page_name', 'Tâches')

@section('content')
    <section class="tasks-list">
        <div class="tasks-title-row no-select" id="my-tasks-title">
            <i class="fas fa-chevron-right rotate-back" id="my-tasks-chevron"></i>
            <h2 class="task-section-title">Mes tâches</h2>
        </div>
        <ul class="element-task" id="my-tasks-list">
            <li class="task">
                <div class="task-button"></div>
                <h2 class="task-title">Coder le système de stabilisation</h2>
                <div class="first-separation-line"></div>
                <div class="task-deadline-box">
                    <i class="fas fa-calendar calendar-icon"></i>
                    <p>24/01/2021</p>
                </div>
                <div class="separation-line"></div>
                <h2 class="project-title">Drone</h2>
            </li>
            <li class="task">
                <div class="task-button"></div>
                <h2 class="task-title">Coder le système de stabilisation</h2>
                <div class="first-separation-line"></div>
                <div class="task-deadline-box">
                    <i class="fas fa-calendar calendar-icon"></i>
                    <p>24/01/2021</p>
                </div>
                <div class="separation-line"></div>
                <h2 class="project-title">Drone</h2>
            </li>
        </ul>
    </section>

    <section class="tasks-list">
        <div class="tasks-title-row" id="available-tasks-title">
            <i class="fas fa-chevron-right rotate-back" id="available-tasks-chevron"></i>
            <h2 class="task-section-title no-select">Tâches disponibles</h2>
        </div>
        <ul class="element-task" id="available-tasks-list">
            <li class="task">
                <div class="task-button"></div>
                <h2 class="task-title">Coder le système de stabilisation</h2>
                <div class="first-separation-line"></div>
                <div class="task-deadline-box">
                    <i class="fas fa-calendar calendar-icon"></i>
                    <p>24/01/2021</p>
                </div>
                <div class="separation-line"></div>
                <h2 class="project-title">Drone</h2>
            </li>
            <li class="task">
                <div class="task-button"></div>
                <h2 class="task-title">Lorem ipsum dolor sit amet. </h2>
                <div class="first-separation-line"></div>
                <div class="task-deadline-box">
                    <i class="fas fa-calendar calendar-icon"></i>
                    <p>24/01/2021</p>
                </div>
                <div class="separation-line"></div>
                <h2 class="project-title">Drone</h2>
            </li>
        </ul>
    </section>
    </main>

@endsection

@push('scripts')
    <script src="/dist/js/tasks.js"></script>
@endpush
