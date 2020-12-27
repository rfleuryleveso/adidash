@extends('layouts.app')

@section('title', 'Nouveau projet')

@section('page_name', 'Nouveau projet')

@section('content')

    <div class="card" style="overflow: visible">
        <header class="card-header">
            <p class="card-header-title">
                Nouveau projet
            </p>
        </header>
        <div class="card-content project-description">
            <form method="POST" route="{{ route('committee.create-project') }}">
                @csrf
                <div class="field">
                    <label class="label">Nom du projet</label>
                    <div class="control">
                        <input class="input @error('name') is-danger @enderror" type="text" name="name" placeholder="Nom">
                    </div>
                    @error('name') <p class="help is-danger">{{ $message }} </p>@enderror
                </div>
                <div class="field">
                    <label class="label">Chef(s) de project</label>
                    <div class="select is-fullwidth">
                        <select multiple id="project-chief-selection" name="project-chiefs[]">
                        </select>
                    </div>
                    @error('project-chiefs') <p class="help is-danger">{{ $message }} </p>@enderror
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
                        <button class="button is-link">Submit</button>
                    </div>
                </div>
            </form>
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
        const group_choices = new Choices('#groups-selection', {
            placeholder: true,
            placeholderValue: 'Sélectionnez un ou plusieurs groups',
            removeItemButton: true,
        })
        group_choices.setChoices(function() {
            return axios.get(
                    "{{ route('committee.groups') }}"
                )
                .then(function(response) {
                    return response.data.data;
                })
                .then(function(data) {
                    return data.map(function(group) {
                        return {
                            value: group.id,
                            label: group.name
                        };
                    });
                });
        });

    </script>
@endpush
