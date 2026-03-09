
@extends('layout')
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height:40px;">
        </a>

        <div class="collapse navbar-collapse" id="guestNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('professor_list') }}">Professors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('grup_list') }}">Grups</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modul_list') }}">Moduls</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('alumne_list') }}">Alumnes</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-primary me-2" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-dark" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
