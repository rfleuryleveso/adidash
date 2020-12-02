@extends('auth.layout')

@section('title', 'Login')

@section('content')
<form action="/register" method="POST">
    @csrf
    <label for="first_name">Name:</label><br>
    <input type="text" id="first_name" name="first_name" placeholder="John"><br>
    @error('first_name')
        {{$message}}
    @enderror
    <label for="last_name">Surname:</label><br>
    <input type="text" id="last_name" name="last_name" placeholder="Doe"><br>
    @error('last_name')
        {{$message}}
    @enderror
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" placeholder="prenom.nom@student.yncrea.fr"><br>
    @error('email')
        {{$message}}
    @enderror
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="password"><br>
    @error('password')
        {{$message}}
    @enderror
    <label for="password_confirmation">Password confirmation:</label><br>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation"><br>
    @error('password_confirmation')
        {{$message}}
    @enderror
    <br>
    
    <input type="submit" value="Submit">
  </form> 
@endsection