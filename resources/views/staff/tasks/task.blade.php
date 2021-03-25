@extends('layouts.app')

@section('title', $task->name)

@section('page_name', "{$project->name} | {$task->name}")

@section('content')
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Résumé de la tâche
                    </p>
                </header>
                <div class="card-content">
                    <x-markdown :content="$task->description"/>
                    <hr/>
                    Statut de la tâche:
                    <x-task-status :status="$task->status"/>
                    <br/>
                    Statut de la notation:
                    @if ($task->notation_status === 'WAITING_FOR_CHIEF')
                        <span class="tag">En attente du chef</span>
                    @elseif($task->notation_status === "WAITING_FOR_STAFF")
                        <span class="tag">En attente du staff</span>
                    @else
                        <span class="tag">Noté</span>
                    @endif

                </div>
            </div>
            <div class="card mt-5">
                <header class="card-header">
                    <p class="card-header-title">
                        Equipe
                    </p>
                </header>
                <div class="card-content">
                    <form method="post"
                          action="{{ route('staff.tasks.task.update-grades', ['task' => $task->id, 'project' => $project->id]) }}">
                        @csrf
                        @foreach ($task->users as $user)
                            <div class="@if(!$loop->first) mt-5 @endif">
                                <h5 class="is-size-5"><i class="fas fa-user"></i> {{ $user->fullName }}
                                    @if ($user->hasClassGroup())
                                        ({{ $user->getClassGroups()->first()->name }}) @endif
                                </h5>
                                {{ $task->deliverables()->whereIn(
                                            'id',
                                            $user->deliverables()->pluck('deliverables.id')->toArray(),
                                        )->count() }} livrable(s) sur cette tâche<br/>
                                <i class="fas fa-users-cog"></i> Chef de projet:
                                @php
                                    $projectChiefGrade = $grades
                                    ->where('user_id', $user->id)
                                    ->where('task_id', $task->id)
                                    ->where('evaluation_type', 'PROJETCHIEF')
                                    ->first();

                                    $staffGrade = $grades
                                    ->where('user_id', $user->id)
                                    ->where('task_id', $task->id)
                                    ->where('evaluation_type', 'STAFF')
                                    ->first();
                                @endphp
                                <p>{{$projectChiefGrade ? $projectChiefGrade->comments : ''}}</p>

                                <br/>

                                <i class="fas fa-user-shield"></i> Staff:
                                <input type="hidden" name="grades[{{$loop->index}}][user]" value="{{ $user->id }}">
                                <div class="select is-small">
                                    <select name="grades[{{$loop->index}}][grade]">
                                        <option @if (!$staffGrade) selected @endif value="-1">Non noté
                                        </option>
                                        <option @if ($staffGrade && $staffGrade->grade == 0) selected
                                                @endif value="0">0 étoiles
                                        </option>
                                        <option @if ($staffGrade && $staffGrade->grade == 1) selected
                                                @endif value="1">1 étoile
                                        </option>
                                        <option @if ($staffGrade && $staffGrade->grade == 2) selected
                                                @endif value="2">2 étoiles
                                        </option>
                                    </select>
                                </div>

                                <textarea class="textarea mt-1" rows="2" placeholder="Entrez vos commentaires"
                                          name="grades[{{$loop->index}}][comments]">{{$staffGrade ? $staffGrade->comments : ''}}</textarea>

                            </div>
                        @endforeach
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input name="notation_finished"
                                           @if($task->notation_status === "FINISHED") checked
                                           @endif type="checkbox">
                                    Notation finie
                                </label>
                            </div>
                        </div>
                        <div class="field is-grouped mt-5">
                            <div class="control">
                                <button class="button is-link is-small">Mettre à jour la notation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Livrables
                    </p>
                </header>
                <div class="card-content">
                    @foreach ($task->deliverables as $deliverable)
                        <div>
                            <h3 class="is-size-5">Livrable #{{ $deliverable->id }}</h3>
                            Lien vers le livrable: <a
                                href="{{ $deliverable->url }}">{{ parse_url($deliverable->url)['host'] }}</a><br/><br/>
                            Membres concernés:
                            <ul>
                                @foreach ($deliverable
            ->users()
            ->withPivot('level')
            ->get()
        as $user)
                                    <li><i class="fas fa-user"></i> {{ $user->fullName }} - {{ $user->pivot->level }}
                                    </li>
                                @endforeach
                            </ul>
                            <br/>
                            Commentaires: <br/>
                            {{ $deliverable->comments }}
                        </div>
                        @if (!$loop->last)
                            <hr/>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
