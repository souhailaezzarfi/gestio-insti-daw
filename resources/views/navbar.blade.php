<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" style="height:40px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">

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


        </div>
    </div>
</nav>