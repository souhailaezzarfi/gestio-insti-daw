@extends('layout')

@section('title', 'Llistat de Grups')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Grups</h1>
<div class="text-end mb-3">
    <a href="{{ route('grup_new') }}" class="btn btn-primary">Nou grup</a>
</div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table class="table table-sm">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Aula</th>
            <th>Tutor</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grups as $grup)
        <tr>

            <td>{{$grup->nom}}</td>
            <td>{{$grup->aula }}</td>
            <td>{{ $grup->professor->cognoms }},{{ $grup->professor->nom }}</td>
            <td>
                <a href="{{ route('grup_edit', ['id' => $grup->id]) }}" class="btn btn-dark mb-3 mx-3">Editar</a>

                <a href="{{ route('grup_delete', ['id' => $grup->id]) }}" class="btn btn-success mb-3">Eliminar</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<br>
@endsection