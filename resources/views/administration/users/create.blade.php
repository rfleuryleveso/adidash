@extends('layouts.app')

@section('title', "Staff | Créer un utilisateur")

@section('page_name', "Staff | Créer un utilisateur")

@section('content')
    <div class="content-container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Créer un nouvel utilisateur
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <form method="POST" action="{{ route('administration.users.create') }}">
                        @csrf
                        <div class="field">
                            <label class="label">Prénom</label>
                            <div class="control">
                                <input name="first_name" class="input" type="text" placeholder="Prénom">
                            </div>
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Nom</label>
                            <div class="control">
                                <input name="last_name" class="input" type="text" placeholder="Nom">
                            </div>
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input name="email" class="input" type="text" placeholder="Email">
                            </div>
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Mot de passe</label>
                            <div class="control">
                                <input name="password" class="input" type="text" placeholder="Mot de passe">
                            </div>
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-bottom">
                            <button type="submit" class="button is-success"><i class="fa fa-plus"></i><span>Créer un
                                tag</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
