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
                @error("first_name") <p class="help is-danger">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                    <input class="input" type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                        placeholder="{{ Auth::user()->last_name }}">
                </div>
                @error("last_name") <p class="help is-danger">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="text" name="email" value="{{ Auth::user()->email }}"
                        placeholder="{{ Auth::user()->email }}">
                </div>
                @error("email") <p class="help is-danger">{{ $message }}</p> @enderror
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" class="button is-link" value="Submit" />
                </div>
            </div>
        </form>
    </div>
@endsection
