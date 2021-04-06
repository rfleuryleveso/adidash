@extends('layouts.app')

@section('title', 'Notation')

@section('page_name', 'Notation')

@section('content')
    <div class="card" style="overflow: visible">
        <header class="card-header">
                <span class="card-header-title">
                    Générer {{rand(0,100) == 0 ? "l'Axcel" : "l'Excel" }}
                </span>
        </header>
        <div class="card-content project-description">
            <form method="POST"
                  action="{{ route('staff.grades.gen-spreadsheet') }}">
                @csrf

                <div class="field">
                    <label class="label">Date de début (Optionnel)</label>
                    <div class="control">
                        <input value="{{date('Y-m-d', $earliestTask->ended_at->timestamp)}}"
                               class="input @error('starts_at') is-danger @enderror" type="date" name="start_date"
                               placeholder="Date de début (optionnel)">
                    </div>
                    <p class="help">La tâche ne sera pas affichée avant cette date</p>
                    @error('starts_at') <p class="help is-danger">{{ $message }} </p>@enderror
                </div>
                <div class="field">
                    <label class="label">Date de fin (Optionnel)</label>
                    <div class="control">
                        <input value="{{date('Y-m-d')}}" class="input @error('ends_at') is-danger @enderror" type="date"
                               name="end_date"
                               placeholder="Date de fin (optionnel)">
                    </div>
                    <p class="help">La date de fin est optionnelle, mais recommandée. Un rappel sera envoyé aux membres
                        la
                        veille de la date de fin si la tâche n'est pas complétée</p>
                    @error('ends_at') <p class="help is-danger">{{ $message }} </p>@enderror
                </div>
                <div class="field">
                    <label class="label">Classes concernées</label>
                    <div class="select is-fullwidth">
                        <select multiple id="groups-selection" name="groups[]">
                        </select>
                    </div>
                    @error('groups') <p class="help is-danger">{{ $message }} </p>@enderror
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="submit-button is-link">Générer le rapport</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        const group_choices = new Choices('#groups-selection', {
            placeholder: true,
            placeholderValue: 'Sélectionnez un ou plusieurs groups',
            removeItemButton: true,
        })
        group_choices.setChoices(function () {
            return axios.get(
                "{{ route('staff.groups') }}"
            )
                .then(function (response) {
                    return response.data.data;
                })
                .then(function (data) {
                    return data.map(function (group) {
                        return {
                            value: group.id,
                            label: group.name
                        };
                    });
                });
        });

    </script>
@endpush
