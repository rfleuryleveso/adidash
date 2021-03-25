@extends('auth.layout')

@section('title', 'Login')

@section('content')

    <div class="auth-container">
        <div class="auth-form-box">
            <h1 class="auth-title">Connexion :</h1>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="auth-section">
                    <label for="email">Email:</label>
                    <input type="mail" name="email" placeholder="Adresse email" class="auth-input-field" />
                </div>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <div class="auth-section">
                    <label for="password">Mot de passe:</label>
                    <input type="password" name="password" placeholder="Mot de passe" class="auth-input-field" />
                </div>
                <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror


                <div class="row">
                    <div class="remember">
                        <input class="remember-me" name="remember" type="checkbox" />
                        <label for="rememeber-me"> Se souvenir de moi </label>
                    </div>
                    <button type="submit" class="submit-button">Se connecter</button>
                </div>


            </form>
            <hr class="auth-separation" />
            <h1 class="auth-link-title">Pas encore de compte ?</h1>
            <a href="{{ route('register') }}" class="auth-link-btn">S'inscrire sur Adidash</a>
        </div>
    </div>


@endsection
