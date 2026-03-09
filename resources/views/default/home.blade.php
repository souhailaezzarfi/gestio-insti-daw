@extends('layout')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow" style="width: 500px;">
        <img src="{{ asset('img/logo.png') }}" class="mb-3" alt="">
        <h2 class="text-center">Gestor Institut Carles Vallbona</h2>
        <p class="text-center text-secondary">Accedeix com a usuari registrar o entra com a convidat per consultar els llistats</p>
         
        <div class="d-grid gap-3 mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-dark" style="background-color:#1f2937">Register</a>
            <a href="{{ route('guest') }}" class="btn btn-success" style="background-color:#059669">Entrar com a guest</a>
        </div>

        <p class="text-center mt-3 text-muted">Guest: només pots veure llistats.<br>Login: pots crear, editar i eliminar.</p>
    </div>
</div>

@endsection 