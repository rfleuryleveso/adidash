@extends('layouts.app')

@section('title', 'Nouveau projet')

@section('page_name', 'Nouveau projet')

    @push('styles')
        <link rel="stylesheet" href="/dist/css/bulma-calendar.min.css" />
    @endpush

@section('content')
    <div class="create-task">
        <div class="card" style="overflow: visible">
            <header class="card-header">
                <span class="card-header-title">
                    Nouvelle tâche
                </span>
            </header>
            <div class="card-content project-description">
                <form method="POST"
                    route="{{ route('project-admin.create-task', ['project' => request()->route()->parameters['project']->id]) }}">
                    @csrf
                    <div class="field">
                        <label class="label">Nom de la tâche</label>
                        <div class="control">
                            <input class="input @error('name') is-danger @enderror" type="text" name="name"
                                placeholder="Nom">
                        </div>
                        @error('name') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field">
                        <label class="label">Description de la tâche</label>
                        <div class="control">
                            <textarea class="textarea @error('description') is-danger @enderror" type="text"
                                name="description" placeholder="Description de la tâche. Supporte le markdown."></textarea>
                        </div>
                        <p class="help">La description sert à décrire au membre de l'équipe ce qu'il doit faire. Elle va
                            servir
                            également de cahier des charges pour la notation. Référence Markdown: <a
                                href="https://guides.github.com/features/mastering-markdown/">https://guides.github.com/features/mastering-markdown/</a>
                        </p>
                        @error('description') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field">
                        <label class="label">Tags</label>
                        <div class="select is-fullwidth">
                            <select multiple id="tags-selection" name="tags[]">
                            </select>
                        </div>
                        <p class="help">Tagger vos tâches permet de les organiser plus efficacement, aux utilisateurs de
                            voir
                            dans quoi ils se lancent plus facilement, et à l'algorithme de proposer des tâches adaptées aux
                            utilisateurs.</p>
                        @error('tags') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field">
                        <label class="label">Tâche parente (Optionnel)</label>
                        <div class="select is-fullwidth">
                            <select id="parent-selection" name="parent_task">
                            </select>
                        </div>
                        <p class="help">Créer une dépendance à une tâche. La tâche ne s'affichera par défaut que quand la
                            tâche
                            parente sera finie. Si la tâche parente est annulée, vous devrez la débloquer vous-même.</p>
                        @error('parent_task') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field">
                        <label class="label">Date de début (Optionnel)</label>
                        <div class="control">
                            <input class="input @error('starts_at') is-danger @enderror" type="date" name="starts_at"
                                placeholder="Date de début (optionnel)">
                        </div>
                        <p class="help">La tâche ne sera pas affichée avant cette date</p>
                        @error('starts_at') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field">
                        <label class="label">Date de fin (Optionnel)</label>
                        <div class="control">
                            <input class="input @error('ends_at') is-danger @enderror" type="date" name="ends_at"
                                placeholder="Date de fin (optionnel)">
                        </div>
                        <p class="help">La date de fin est optionnelle, mais recommandée. Un rappel sera envoyé aux membres
                            la
                            veille de la date de fin si la tâche n'est pas complétée</p>
                        @error('ends_at') <p class="help is-danger">{{ $message }} </p>@enderror
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="submit-button is-link">Créer la tâche</button>
                        </div>
                    </div>
                    @foreach ($errors as $error)
                        {{ $error->message }}
                    @endforeach
                </form>
            </div>

        </div>
    </div>
@endsection



@push('scripts')
    <script src="/dist/js/create-task.js"></script>
    <script>
        const tasks_choices = new Choices("#parent-selection", {
            placeholder: true,
            placeholderValue: "Sélectionnez une task",
            removeItemButton: true
        });
        tasks_choices.setChoices(function() {
            return axios
                .get(
                    "{{ route('project-admin.tasks', ['project' => request()->route()->parameters['project']->id]) }}"
                )
                .then(function(response) {
                    return response.data.data;
                })
                .then(function(data) {
                    return data.map(function(task) {
                        return {
                            value: task.id,
                            label: task.name
                        };
                    });
                });
        });

    </script>
@endpush
