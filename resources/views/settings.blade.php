@extends('layouts.app')

@section('title', 'Paramètres')

@section('page_name', 'Paramètres')

@section('content')
    <div class="box">
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
                            <option value="{{ $group->id }}" @if (Auth::user()->hasClassGroup() && $group->id == Auth::user()->getClassGroups()->first()->id)
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
                    <input class="input" type="password" name="password" required placeholder="Votre mot de passe.">
                </div>
                @error('password') <p class="help is-danger">{{ $message }}</p> @enderror
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" class="button is-link" value="Mettre à jour" />
                </div>
            </div>
        </form>
    </div>
@endsection
