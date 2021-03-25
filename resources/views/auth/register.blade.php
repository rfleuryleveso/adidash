@extends('auth.layout')

@section('title', 'Login')

@section('content')

    <div class="auth-container">
        <div class="auth-form-box">
            <h1 class="auth-title">S'inscrire :</h1>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="auth-section short-auth-section">
                        <label>Nom</label>
                        <input type="text" name="last_name" placeholder="Nom" class="auth-input-field" />
                    </div>
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror


                    <div class="auth-section short-auth-section">
                        <label>Prénom</label>
                        <input type="text" name="first_name" placeholder="Prénom" class="auth-input-field" />
                    </div>
                    @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>


                <div class="auth-section">
                    <label>Email</label>
                    <input type="mail" name="email" placeholder="Adresse email" class="auth-input-field" />
                </div>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <div class="auth-section">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="Mot de passe" class="auth-input-field" />
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <div class="auth-section">
                    <label>Confirmer Mot de passe</label>
                    <input type="password" name="password_confirmation" placeholder="Confirmer Mot de passe"
                        class="auth-input-field" />
                </div>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror



                <div class="form-bottom">
                    <button type="submit" class="submit-button">S'inscrire</button>
                </div>
            </form>

            <hr class="auth-separation" />
            <h1 class="auth-link-title">Vous avez déjà un compte ?</h1>
            <a href="{{ route('login') }}" class="auth-link-btn">Se connecter</a>
        </div>
    </div>
@endsection
