@extends('auth.layout')

@section('title', 'Login')

@section('content')


    <div class="auth-container">
        <div class="auth-form-box">
            <h1 class="auth-title">S'inscrire :</h1>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="name-row">
                    <div>
                        <label for="first_name">Prénom :</label>
                        <div class="auth-form-input short">
                            <i class="gg-profile"></i><input type="text" id="first_name" class="register-auth-field"
                                name="first_name" placeholder="Prénom">
                        </div>
                        @error('first_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>



                    <div>
                        <label for="last_name">Nom :</label>
                        <div class="auth-form-input short">
                            <i class="gg-profile"></i><input type="text" id="last_name" class="register-auth-field"
                                name="last_name" placeholder="Nom">
                        </div>
                        @error('last_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <label for="email">Email:</label>
                <div class="auth-form-input">
                    <i class="gg-mail"></i><input class="auth-field" type="text" id="email" name="email"
                        placeholder="prenom.nom@yncrea.fr">
                </div>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="password">Mot de passe:</label>
                <div class="auth-form-input">
                    <i class="gg-lock"></i><input class="auth-field" type="password" id="password" name="password"
                        placeholder="Mot de passe">
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="password_confirmation">Confirmer le mot de passe :</label>
                <div class="auth-form-input">
                    <i class="gg-lock"></i><input class="auth-field" type="password" id="password_confirmation"
                        name="password_confirmation" placeholder="Confirmer le mot de passe">
                </div>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror



                <div class="form-bottom">
                    <button type="submit" class="submit-button">S'inscrire</button>
                    <p class="switch-button">Déja inscrit ? <a href="{{ route('login') }}">Se connecter</a>
                    </p>
                </div>

            </form>
        </div>
    </div>
@endsection
