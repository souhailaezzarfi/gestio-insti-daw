<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Project - @yield('title')</title>
        @section('stylesheets')
	    <link rel="stylesheet" href="{{ asset('css/taula.css') }}" />
        @show
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @include('navbar')

        <div class="container">
           
            @yield('content')

        </div>
    </body>
</html>