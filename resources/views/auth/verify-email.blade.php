@extends('auth.layout')

@section('title', 'Login')

@section('content')

    <div class="auth-container">
        <div class="auth-form-box">

            <h1 class="auth-title">Vérification de l'email</h1>
            <p>Pour accèder à Adidash, vous devez vérifier votre adresse email</p>
            <p>Connectez vous sur votre adresse junia et cliquez sur le lien pour valider votre compte</p>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    Un nouvel email de vérification vous à été envoyé
                </div>
            @endif
            <form method="POST" action="{{url('/email/verification-notification')}}">
                @csrf
                <button type="submit" class="submit-button">Renvoyer l'email de vérification</button>
            </form>
        </div>
    </div>


@endsection
