@extends('auth.layout')

@section('title', 'Login')

@section('content')

    <head>
        <link rel="stylesheet" href="/dist/css/app.css" />
    </head>

    <body>
        <div class="auth-container">
            <h1 class="auth-title">Connexion :</h1>

            <form action="/login" method="POST">
                @csrf
                <label for="email">Email:</label><br>
                @if ($errors->any())
                    <div class="auth-form red-input">
                    @else
                        <div class="auth-form">
                @endif

                <i class="gg-mail"></i><input class="auth-field" type="text" id="email" name="email"
                    placeholder="prenom.nom@yncrea.fr">
        </div>

        <label for="password">Mot de passe:</label><br>
        @if ($errors->any())
            <div class="auth-form red-input">
            @else
                <div class="auth-form">
        @endif

        <i class="gg-lock"></i><input class="auth-field" type="password" id="password" name="password"
            placeholder="Mot de passe"></div>
        @error('password')
            {{ $message }}
        @enderror

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="remember">
            <label for="remember">Rester connecté ?</label>
            <input type="checkbox" id="remember" name="remember">
        </div>
        <div class="form-button">
            <button type="submit" class="submit-button">Se connecter</button>
        </div>
        </form>
        </div>
    </body>
@endsection
