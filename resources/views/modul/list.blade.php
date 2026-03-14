@extends('layout')

@section('title', 'Llistat de moduls')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Mòduls</h1>
<div class="text-end mb-3">
    <a href="{{ route('modul_new') }}" class="btn btn-primary">Nou mòdul</a>
</div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<form action="{{ route('modul_cercar') }}" method="get">
    <label><strong>Filtrar per professor:</strong></label>
    <select name="filtrarPerProfessor" id="">
        <option value="">-- Tots --</option>

        @foreach ($professors as $professor)
        <option value="{{ $professor->id }}" @selected($selectedProfessor==$professor->id)>{{ $professor->nom }} {{ $professor->cognoms }}</option>
        @endforeach
    </select>

    <br>
    <input type="submit" value="Aplicar" class="btn btn-primary mt-3 mb-3">
    <input type="reset" value="Rest" class="btn btn-dark mt-3 mb-3">
</form>



<table class="table table-sm">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Hores</th>
            <th>Professor</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($moduls as $modul)
        <tr>

            <td>{{$modul->nom }}</td>
            <td>{{ $modul->hores }}</td>
            <td>
                @if ($modul->professor)
                {{ $modul->professor->cognoms }}, {{ $modul->professor->nom }}
                @else
                <span class="text-danger">Sense professor</span>
                @endif
            </td>

            <td>
                <a href="{{ route('modul_edit', ['id' => $modul->id]) }}" class="btn btn-dark mb-3 mx-3">Editar</a>

                <a href="{{ route('modul_delete', ['id' => $modul->id]) }}" class="btn btn-success mb-3">Eliminar</a>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<br>
@endsection