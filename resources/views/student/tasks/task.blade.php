@extends('layouts.app')

@section('title', 'Tâches | ' . $task->name)

@section('page_name', 'Tâches | ' . $task->name)

@section('content')
    <div class="columns is-desktop">
        <div class="column is-two-third-desktop">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Tâche {{ $task->name }}
                    </p>
                </header>
                <div class="card-content task-description">
                    <x-markdown :content="$task->description" />
                </div>
            </div>
            @if ($task->users->contains(Auth::user()))
                <h3 class="is-size-4 mt-3">Livrables</h3>
                @if ($task->deliverables()->count() > 0)
                    @foreach ($task->deliverables as $deliverable)
                        <div class="card mt-3">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Livrable #{{ $deliverable->id }}
                                </p>
                            </header>
                            <div class="card-content task-description">
                                <div class="columns is-desktop">
                                    <div class="column is-two-third-desktop">
                                        Lien vers le livrable: <a
                                            href="{{ $deliverable->url }}">{{ parse_url($deliverable->url)['host'] }}</a><br />
                                        <b>Commentaires:</b> <br />
                                        {{ $deliverable->comments }}
                                        @if (Auth::user()->can('delete', $deliverable))
                                            <form method="POST"
                                                action="{{ route('student.deliverable.destroy', ['deliverable' => $deliverable->id]) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="button is-danger is-small mt-3">Supprimer</button>
                                            </form>
                                        @endif


                                    </div>
                                    <div class="column is-one-third-desktop">
                                        Membres concernés:
                                        <ul>
                                            @foreach ($deliverable
            ->users()
            ->withPivot('level')
            ->get()
        as $user)
                                                <li><i class="fas fa-user"></i> {{ $user->fullName }} -
                                                    {{ $user->pivot->level }}
                                                    @if ($user->pivot->level == 'MEMBER' and Auth::user()->can('update', $deliverable))
                                                        <form method="POST"
                                                            action="{{ route('student.deliverable.remove-user', ['deliverable' => $deliverable->id]) }}"
                                                            style="display: inline; cursor: pointer;">
                                                            @csrf
                                                            <input type="hidden" name="user" value="{{ $user->id }}" />
                                                            <input type="submit" value="( X )"
                                                                style="display: inline; text-decoration: none; border: 0; background: transparent; cursor: pointer;" />
                                                        </form>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul><br />
                                        @if (Auth::user()->can('update', $deliverable))
                                            <form method="POST"
                                                action="{{ route('student.deliverable.add-user', ['deliverable' => $deliverable->id]) }}">
                                                @csrf

                                                <p class="has-text-grey">Ajouter un membre: </p>

                                                @if ($task->users
            ->except(Auth::id())
            ->except(
                $deliverable
                    ->users()
                    ->pluck('users.id')
                    ->all(),
            )
            ->count() > 0)
                                                    <div class="field has-addons">
                                                        <div class="control is-expanded">
                                                            <div class="select is-fullwidth">
                                                                <select name="user">
                                                                    @foreach ($task->users->except(Auth::id())->except(
            $deliverable
                ->users()
                ->pluck('users.id')
                ->all(),
        )
        as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->fullName }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <p class="control">
                                                            <input class="button is-info" value="Ajouter" type="submit" />
                                                        </p>
                                                    </div>
                                                @else
                                                    Aucun membre à ajouter.
                                                @endif


                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                @else
                    Pas encore de livrable sur la tâche
                @endif
                <div class="card mt-3">
                    <header class="card-header">
                        <p class="card-header-title">
                            Ajouter un livrable
                        </p>
                    </header>
                    <div class="card-content task-description">

                        <div>
                            <form method="POST" action="{{ route('student.deliverable.store') }}">
                                @csrf
                                <input type="hidden" name="task" value="{{ $task->id }}" />
                                <div class="field">
                                    <label class="label">Lien</label>
                                    <div class="control">
                                        <input class="input" type="text" name="link"
                                            placeholder="Lien complet vers votre livrable.">
                                    </div>
                                    @error('link') <p class="help is-danger">{{ $message }} </p>@enderror
                                </div>
                                <div class="field">
                                    <label class="label">Commentaires</label>
                                    <div class="control">
                                        <textarea class="textarea" name="comments" placeholder="Commentaires"></textarea>
                                    </div>
                                    @error('comments') <p class="help is-danger">{{ $message }} </p>@enderror
                                </div>
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button class="button is-link">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="column is-one-third-desktop">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Informations
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        Membres assignés:
                        @if ($task->users()->count() > 0)
                            <ul>
                                @foreach ($task->users as $user)
                                    <li>{{ $user->fullName }}</li>
                                @endforeach
                            </ul>
                        @else
                            Pas de Membres<br />
                        @endif

                        Date de début:
                        @if ($task->starts_at)
                            {{ $task->starts_at->toDateString() }}
                        @else
                            Inconnu
                        @endif
                        <br />

                        Date de fin:
                        @if ($task->ends_at)
                            {{ $task->ends_at->toDateString() }}
                            @if ($task->ends_at->isPast())
                                <span class="tag is-warning">(Retard
                                    {{ $task->ends_at->shortAbsoluteDiffForHumans() }})
                                </span>
                            @endif
                        @else
                            Inconnu
                        @endif
                        <br />

                        Etat:
                        <x-task-status :status="$task->status" />
                    </div>
                </div>
            </div>
            @if ($task->users->contains(Auth::user()))
                <a href="{{ route('student.tasks.task.leave', ['task' => $task->id]) }}"
                    class="button is-danger mt-3 is-fullwidth">Quitter la tâche</a>
            @else
                <a href="{{ route('student.tasks.task.join', ['task' => $task->id]) }}"
                    class="button is-primary mt-3 is-fullwidth">Se rajouter à la tâche</a>
            @endif

            @if (Auth::user()->can('update', $task))
                @if ($task->status == 'WAITING')
                    <form method="POST" action="{{ route('student.tasks.task.set-status', ['task' => $task->id]) }}">
                        @csrf
                        <input type="hidden" name="status" value="STARTED" />
                        <button type="submit" class="button is-success is-fullwidth mt-3">Définir comme démarrée</button>
                    </form>
                @elseif($task->status == "STARTED")
                    <form method="POST" action="{{ route('student.tasks.task.set-status', ['task' => $task->id]) }}">
                        @csrf
                        <input type="hidden" name="status" value="FINISHED" />
                        <button type="submit" class="button is-success is-fullwidth mt-3">Définir comme finie</button>
                    </form>
                @elseif($task->status == "FINISHED")
                    <form method="POST" action="{{ route('student.tasks.task.set-status', ['task' => $task->id]) }}">
                        @csrf
                        <input type="hidden" name="status" value="STARTED" />
                        <button type="submit" class="button is-success is-fullwidth mt-3">Définir comme en cours</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const chief_choices = new Choices('#project-chief-selection', {
            placeholder: true,
            placeholderValue: 'Sélectionnez un ou des chefs de projet',
            removeItemButton: true,
        })
        chief_choices.setChoices(function() {
            return axios.get(
                    "{{ route('committee.users') }}"
                )
                .then(function(response) {
                    return response.data.data;
                })
                .then(function(data) {
                    return data.map(function(user) {
                        return {
                            value: user.id,
                            label: user.full_name
                        };
                    });
                });
        });

    </script>
@endpush
