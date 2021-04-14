@extends('layouts.app')

@section('title', 'Paramètres')

@section('page_name', 'Paramètres')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Mettre à jour le profil
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Prénom</label>
                        <div class="control">
                            <input class="input" type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                                   placeholder="{{ Auth::user()->first_name }}">
                        </div>
                        @error('first_name') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                            <input class="input" type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                                   placeholder="{{ Auth::user()->last_name }}">
                        </div>
                        @error('last_name') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="text" name="email" value="{{ Auth::user()->email }}"
                                   placeholder="{{ Auth::user()->email }}">
                        </div>
                        @error('email') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Classe</label>
                        <div class="select">
                            <select name="class_group">
                                @foreach ($availableGroups as $group)
                                    <option value="{{ $group->id }}"
                                            @if (Auth::user()->hasClassGroup() && $group->id == Auth::user()->getClassGroups()->first()->id)
                                            selected="selected"
                                        @endif
                                    >{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('class_group') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Mot de passe actuel</label>
                        <div class="control">
                            <input class="input" type="password" name="password" required
                                   placeholder="Votre mot de passe.">
                        </div>
                        @error('password') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit" class="button is-link" value="Mettre à jour"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <header class="card-header">
            <p class="card-header-title">
                Mettre à jour le mot de passe
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <form method="POST" action="{{ route('settings.update-password') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Mot de passe actuel</label>
                        <div class="control">
                            <input class="input" type="password" name="old_password" required
                                   placeholder="Votre mot de passe actuel">
                        </div>
                        @error('old_password') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Nouveau mot de passe</label>
                        <div class="control">
                            <input class="input" type="password" name="password" required
                                   placeholder="Votre nouveau mot de passe">
                        </div>
                        @error('password') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field">
                        <label class="label">Confirmation du nouveau mot de passe</label>
                        <div class="control">
                            <input class="input" type="password" name="password_confirmation" required
                                   placeholder="Confirmez votre nouveau mot de passe">
                        </div>
                        @error('password_confirmation') <p class="help is-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit" class="button is-link" value="Mettre à jour"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
