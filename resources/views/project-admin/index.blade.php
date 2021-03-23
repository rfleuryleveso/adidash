@extends('layouts.app')

@section('title', $project->name)

@section('page_name', 'Gestion de projet | ' . $project->name)

@section('content')
    <div class="project-admin-content">
        @if ($project->status == 'CREATED')
            <article class="message is-info">
                <div class="message-header">
                    <p>Projet en attente</p>
                </div>
                <div class="message-body">
                    Bienvenue sur votre nouveau projet.
                    Actuellement, les autres étudiants ne peuvent pas voir votre projet. Vous pouvez créer vos tâches et
                    modifier le nom et la description pour le personnaliser.
                    Une fois que vous aurez cliquer sur le bouton "activer mon projet", tout le monde pourra voir votre
                    projet
                    et il sera marqué comme commencé
                    <form method="POST" action="{{ route('project-admin.update', ['project' => $project->id]) }}">
                        @csrf
                        <input type="hidden" name="status" value="STARTED" />
                        <div class="field is-grouped mt-3">
                            <div class="control">
                                <button class="button is-link">Activer le projet</button>
                            </div>
                        </div>
                        <div class="message-body">
                            Bienvenue sur votre nouveau projet.
                            Actuellement, les autres étudiants ne peuvent pas voir votre projet. Vous pouvez créer vos
                            tâches et
                            modifier le nom et la description pour le personnaliser.
                            Une fois que vous aurez cliquer sur le bouton "activer mon projet", tout le monde pourra voir
                            votre
                            projet
                            et il sera marqué comme commencé
                            <form method="POST" action="{{ route('project-admin.update', ['project' => $project->id]) }}">
                                @csrf
                                <input type="hidden" name="status" value="STARTED" />
                                <div class="field is-grouped mt-3">
                                    <div class="control">
                                        <button class="button is-link">Activer le projet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
            </article>
        @endif
        <div class="columns">
            <div class="column is-one-fifth">
                <div class="card has-background-link has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    Membres
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
            <div class="column is-one-fifth">
                <div class="card has-background-info has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    Tâches
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
            <div class="column is-one-fifth">
                <div class="card has-background-primary has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En cours
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'STARTED')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-one-fifth">
                <div class="card has-background-success has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    Finies
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'FINISHED')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-one-fifth">
                <div class="card has-background-warning has-text-white">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column">
                                <p class="is-size-5 m-0">
                                    Tâches
                                </p>
                                <p class="is-size-7 m-0">
                                    En retard
                                </p>
                            </div>
                            <div class="column">
                                <p class="is-size-3 has-text-right">
                                    {{ $project->tasks()->where('status', 'STARTED')->whereDate('ends_at', '<', \Carbon\Carbon::now())->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="columns is-multiline">
            <div class="column is-half">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Tâches finies en attente de notation
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Equipe</th>
                                        <th>Fin</th>
                                        <th>Fin attendue</th>
                                        <th>Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finished_tasks as $task)
                                        <tr>
                                            <th>{{ $task->name }}</th>
                                            <td>{{ $task->users->map(function ($member) {
        return $member->fullName;
    })->join(', ') }}
                                            </td>
                                            <td>
                                                @if ($task->ended_at != null)
                                                    {{ $task->ended_at->toDateString() }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($task->ends_at != null)
                                                    {{ $task->ends_at->toDateString() }}
                                                    @if ($task->ends_at->isPast())
                                                        <span class="tag is-warning">(Retard
                                                            {{ $task->ends_at->shortAbsoluteDiffForHumans() }})
                                                        </span>
                                                    @endif
                                                @else
                                                    Inconnu
                                                @endif
                                            </td>
                                            <td><a href=""><i class="far fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-half">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Membres de l'équipe
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Membre</th>
                                        <th>Classe</th>
                                        <th>Tâches finies</th>
                                        <th>Tâches en cours</th>
                                        <th>Administration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        <tr>
                                            <th>
                                                @switch($member->pivot->relation_type)
                                                    @case(0)
                                                    {{ $member->fullName }}
                                                    @break
                                                    @case(1)
                                                    <span class="has-text-info">{{ $member->fullName }} <i
                                                            class="fas fa-eye"></i></span>
                                                    @break

                                                    @case(2)
                                                    <span class="has-text-warning">{{ $member->fullName }} <i
                                                            class="fas fa-tools"></i></span>
                                                    @break

                                                    @case(3)
                                                    <span class="has-text-danger">{{ $member->fullName }} <i
                                                            class="fas fa-user-shield"></i></span>
                                                    @break

                                                @endswitch
                                            </th>
                                            <td>{{ $member->getClassGroups()->get()->map(function ($classGroup) {
        return $classGroup->name;
    })->join(', ') }}
                                            </td>
                                            <td>
                                                {{ $member->tasks()->where('status', 'FINISHED')->whereIn('tasks.id', $tasksIds)->count() }}
                                            </td>
                                            <td>
                                                {{ $member->tasks()->where('status', 'STARTED')->whereIn('tasks.id', $tasksIds)->count() }}
                                            </td>
                                            <td>
                                                @if ($member->pivot->relation_type == 0)
                                                    <a data-tooltip="Ce membre pourra créer de nouvelles tâches"
                                                        href="{{ route('project-admin.member.set-rank', ['project' => $project->id, 'member' => $member->id, 'rank' => 2]) }}">Promouvoir</a>
                                                @endif
                                                @if ($member->pivot->relation_type == 2)
                                                    <a
                                                        href="{{ route('project-admin.member.set-rank', ['project' => $project->id, 'member' => $member->id, 'rank' => 0]) }}">Rétrograder</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>
                                Légende: <span class="has-text-danger">Administrateur <i
                                        class="fas fa-user-shield"></i></span>,
                                <span class="has-text-warning">Sous-Administrateur <i class="fas fa-tools"></i></span>,
                                <span class="has-text-info">Client <i class="fas fa-eye"></i></span>, Membre
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="column is-full">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Paramètres du projet
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <form method="POST"
                                action="{{ route('project-admin.update', ['project' => $project->id]) }}">
                                @csrf
                                <div class="field">
                                    <label class="label">Nom du projet</label>
                                    <div class="control">
                                        <input class="input" name="name" value="{{ $project->name }}" type="text"
                                            placeholder="Text input">
                                    </div>
                                </div>


                                <div class="field">
                                    <label class="label">Description</label>
                                    <div class="control">
                                        <textarea class="textarea" name="description"
                                            placeholder="Textarea">{{ $project->description }}</textarea>
                                    </div>
                                </div>


                                <div class="field">
                                    <label class="label">Accepter de nouveaux membres</label>
                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="allow_new_member" value="true" @if ($project->allow_new_member) checked @endif>
                                            Oui
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="allow_new_member" value="false" @if (!$project->allow_new_member) checked @endif>
                                            Non
                                        </label>
                                    </div>
                                </div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button class="button is-link">Submit</button>
                                    </div>
                                    <div class="control">
                                        <button class="button is-link is-light">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
