<li class="task">
    <a href="">
        <div class="task-button"></div>
        <h2 class="task-title">{{$task->name}}</h2>
        <div class="separation-line"></div>
        <div class="task-deadline-box">
            <i class="far fa-calendar calendar-icon"></i>
            <p>{{$task->ends_at ? $task->ends_at->toDateString() : 'Inconnu'}}</p>
        </div>
        <div class="separation-line"></div>
        <h2 class="project-title">{{ $task->project->name }}</h2>
    </a>
</li>
