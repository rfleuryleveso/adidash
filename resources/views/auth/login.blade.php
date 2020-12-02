@extends('auth.layout')

@section('title', 'Login')

@section('content')
<form action="/login" method="POST">
    @csrf
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" placeholder="prenom.nom@yncrea.fr"><br>
    @error('username')
        {{$message}}
    @enderror
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="password"><br>
    @error('password')
        {{$message}}
    @enderror
    
    <label for="remember">Remember me ?</label><br/>
    <input type="checkbox" id="remember" name="remember"><br>
    <input type="submit" value="Submit">
  </form> 
@endsection