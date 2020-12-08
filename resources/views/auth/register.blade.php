@extends('auth.layout')

@section('title', 'Login')

@section('content')


    <div class="auth-container">
        <div class="auth-form-box">
            <h1 class="auth-title">S'inscrire :</h1>

            <form action="/register" method="POST">
                @csrf
                <div class="name-row">
                    <div>
                        <label for="first_name">Prénom :</label>
                        <div class="auth-form-input short">
                            <i class="gg-profile"></i><input type="text" id="first_name" class="register-auth-field"
                                name="first_name" placeholder="Prénom">
                        </div>
                    </div>



                    <div>
                        <label for="last_name">Nom :</label>
                        <div class="auth-form-input short">
                            <i class="gg-profile"></i><input type="text" id="last_name" class="register-auth-field"
                                name="last_name" placeholder="Nom">
                        </div>
                    </div>
                </div>


                <label for="email">Email:</label>
                <div class="auth-form-input">
                    <i class="gg-mail"></i><input class="auth-field" type="text" id="email" name="email"
                        placeholder="prenom.nom@yncrea.fr">
                </div>

                <label for="password">Mot de passe:</label>
                <div class="auth-form-input">
                    <i class="gg-lock"></i><input class="auth-field" type="password" id="password" name="password"
                        placeholder="Mot de passe">
                </div>

                <label for="password_confirmation">Confirmer le mot de passe :</label>
                <div class="auth-form-input">
                    <i class="gg-lock"></i><input class="auth-field" type="password" id="password_confirmation"
                        name="password_confirmation" placeholder="Confirmer le mot de passe">
                </div>

                @error('first_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                @error('last_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                @error('mail')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror


                <div class="form-bottom">
                    <button type="submit" class="submit-button">S'inscrire</button>
                    <a class="submit-button switch-button">Se connecter</a>
                </div>

            </form>
        </div>
    </div>
@endsection
