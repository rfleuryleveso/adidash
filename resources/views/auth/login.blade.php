@extends('auth.layout')

@section('title', 'Login')

@section('content')
    <div class="auth-form-box">
        <h1 class="auth-title">Connexion :</h1>
        <form action="/login" method="POST">
            @csrf

            <div>
                <label for="email">Email:</label><br>
                @if ($errors->has('email'))
                    <div class="auth-form-input red-input">
                    @else
                        <div class="auth-form-input">
                @endif

                <i class="gg-mail"></i><input class="auth-field" type="text" id="email" name="email"
                    placeholder="prenom.nom@yncrea.fr">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div>

                <label for="password">Mot de passe:</label><br>
                @if ($errors->any())
                    <div class="auth-form-input red-input">
                    @else
                        <div class="auth-form-input">
                @endif

                <i class="gg-lock"></i><input class="auth-field" type="password" id="password" name="password"
                    placeholder="Mot de passe">

                @error('password')
                    {{ $message }}
                @enderror
            </div>


            <div class="remember">
                <label for="remember">Rester connecté ?</label>
                <input type="checkbox" id="remember" name="remember">
            </div>
            <div class="form-bottom">
                <button type="submit" class="submit-button">Se connecter</button>
                <p class="switch-button">Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a>
                </p>
            </div>
        </form>
    </div>


@endsection
