@extends('layouts.app')

@section('title', 'Comité de projets | Tags')

@section('page_name', 'Comité de projets | Tags')

@section('content')
    <div>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Icon</th>
                    <th>Couleur</th>
                    <th>Utilisations</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th>{{ $tag->id }}</th>
                        <th>
                            <x-task-tag :tag="$tag" />
                        </th>
                        <th>
                            @if ($tag->icon) <i class="{{ $tag->icon }}"></i>
                            ({{ $tag->icon }}) @else Pas d'icone @endif
                        </th>
                        <th>{{ $tag->color }}</th>
                        <th>{{ $tag->tasks_count }} </th>
                        <th><a href="{{ route('committee.tags.delete', ['tag' => $tag->id]) }}"><i
                                    class="fas fa-trash"></i></a></th>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Créer un nouveau tag
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('committee.tags.create') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                            <input name="name" class="input" type="text"
                                placeholder="Un nom court et concis est préférable. Exemple: électronique, programmation, soudure">
                        </div>
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Couleur</label>
                        <div class="select">
                            <select name="color">
                              <option value="is-black">Noir</option>
                              <option value="is-dark">Gris foncé</option>
                              <option value="is-light">Gris clair</option>
                              <option value="is-white">Blanc</option>
                              <option value="is-primary">Turquoise</option>
                              <option value="is-link">Bleu</option>
                              <option value="is-info">Cyan</option>
                              <option value="is-success">Vert</option>
                              <option value="is-warning">Jaune</option>
                              <option value="is-danger">Rouge</option>
                            </select>
                        </div>
                        @error('color')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="field">
                        <label class="label">Icon</label>
                        <div class="control">
                            <input name="icon" class="input" type="text"
                                placeholder="Optionnel, l'identifiant d'une icon fontAwesome. Exemple: fas fa-home">
                        </div>
                        <p class="help">Liste entière des icones: <a href="https://fontawesome.com/icons">fontawesome.com</a></p>
                        @error('icon')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-bottom">
                        <button type="submit" class="submit-button button is-success">Créer un tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
