@extends('layout')

@section('title', 'Llistat de alumnes')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Alumnes</h1>
<div class="text-end mb-3">
    <a href="{{ route('alumne_new') }}" class="btn btn-primary">Nou alumne</a>
</div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<form action="{{ route('alumne_filtrar') }}" method="get">
    <label><strong>Cerca(DNI o Cognoms):</strong></label>
    <input type="text" name="dniOcognoms" id="" value="{{$text}}">

    <label><strong>Grup:</strong></label>
    <select name="filtrarPerGrup" id="">
        <option value="">-- Tots --</option>

        @foreach ($grups as $grup)
        <option value="{{ $grup->id }}" @selected($selectedGrup==$grup->id)>{{ $grup->nom }}</option>
        @endforeach
    </select>

    <label class="ms-5"><strong>Nota mínima:</strong></label>
    <input type="number" name="nota" step="0.01" value="{{$nota}}">

    <label class="ms-5"><strong>Operador:</strong></label>
    <select name="operador" id="" value="{{$operador}}">
        <option value="and">AND</option>
        <option value="or">OR</option>
    </select>
    <br>
    <input type="submit" value="Aplicar" class="btn btn-primary mt-3 mb-3">
    <a href="{{ route('alumne_list') }}" class="btn btn-dark mt-3 mb-3"> Netejar </a>
</form>



<table class="table table-sm">
    <thead>
        <tr>
            <th>Nom</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Naixement</th>
            <th>Telèfon</th>
            <th>Grup</th>
            <th>Mòduls</th>
            <th>Mitjana</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alumnes as $alumne)
        <tr>

            <td>{{$alumne->cognoms}},{{$alumne->nom}} </td>
            <td>{{$alumne->dni }}</td>
            <td>{{$alumne->email }}</td>
            <td>{{ $alumne->data_naixement }}</td>
            <td>{{ $alumne->telefon }}</td>
            <td>{{ $alumne->grup->nom }}</td>
            <td>@foreach ($alumne->moduls as $modul)
                {{ $modul->nom }}({{$modul->pivot->nota}}) <br>
                @endforeach
            </td>


            <td>
                <a href="{{ route('alumne_edit', ['id' => $alumne->id]) }}" class="btn btn-dark mb-3 mx-3">Editar</a>

                <a href="{{ route('alumne_delete', ['id' => $alumne->id]) }}" class="btn btn-success mb-3">Eliminar</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<br>
@endsection