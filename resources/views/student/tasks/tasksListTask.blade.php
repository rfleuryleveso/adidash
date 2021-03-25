<li class="task">
    <a href="{{ route('student.tasks.task', ['task' => $task->id]) }}">
        <div class="task-button"></div>
        <div class="task-title-container">
            <h2 class="task-title">{{ $task->name }}</h2>
        </div>
        <div class="separation-line"></div>
        <div class="task-deadline-box">
            <i class="far fa-calendar calendar-icon"></i>
            <p>{{ $task->ends_at ? $task->ends_at->toDateString() : 'Inconnu' }}</p>
        </div>
        <div class="separation-line"></div>
        <div class="project-title-container">
            <h2 class="project-title">{{ $task->project->name }}</h2>
        </div>
    </a>
</li>
