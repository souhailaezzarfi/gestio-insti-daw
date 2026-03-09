@extends('layout')

@section('title', 'Llistat de professors')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Professors</h1>
    <div class="text-end mb-3">
    @auth<a href="{{ route('professor_new') }}" class="btn btn-primary">Nou professor</a>@endauth

    </div>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

     <form action="{{ route('professor_ordenar') }}" method="get" >
    <label><strong>Ordenar per:</strong></label>
    <select name="ordenarPer" id="">
        <option value="nom" @selected($camp == 'nom')>Nom</option>
        <option value="cognoms" @selected($camp == 'cognoms')>Cognoms</option>
    </select>
   
    <label class="ms-5"><strong>Direcció:</strong></label>
    <select name="direccio" id="">
        <option value="asc" @selected($direccio == 'asc')>ASC</option>
        <option value="desc" @selected($direccio == 'desc')>DESC</option>
    </select>

    <br>
    <input type="submit" value="Aplicar" class="btn btn-primary mt-3 mb-3">
    <input type="reset" value="Rest" class="btn btn-dark mt-3 mb-3">
    </form>



    <table class="table table-sm" >
        <thead>
            <tr>
                <th>Foto</th><th>Nom</th><th>Email</th><th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professors as $professor)
                <tr>
                    <td><img src="{{ asset(env('RUTA_FOTOS') . '/' . $professor->foto) }}" width="100"></td>
                    <td>{{$professor->cognoms}}, {{$professor->nom }}</td><td>{{ $professor->email }}</td>
                    <td>
                        @auth<a href="{{ route('professor_edit', ['id' => $professor->id]) }}"  class="btn btn-dark mb-3 mx-3">Editar</a>@endauth

                        @if(auth()->user()->rol === 'admin')<a href="{{ route('professor_delete', ['id' => $professor->id]) }}"  class="btn btn-success mb-3">Eliminar</a>@endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <br>
@endsection