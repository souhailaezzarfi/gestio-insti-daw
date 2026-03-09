@extends('layout')

@section('title', 'Crear un nou grup')

@section('stylesheets')
    @parent
@endsection
 
@section('content')
    <h1 class="text-center">Nou Grup</h1>
    <div class="container d-flex justify-content-center">
	<div class="p-4 shadow rounded" style="max-width: 700px; width: 100%;">
       <form method="POST" action="{{ route('grup_new') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control">
        
    </div>

    <div class="mb-3">
        <label for="aula" class="form-label">Aula</label>
        <input type="text" name="aula" id="aula" class="form-control">
        
    </div>
    

    <div class="mb-3">
        <label for="professor_id" class="form-label">Tutor(Professor)</label>
        <select name="professor_id" class="form-control">
          <option value="">-- Selecciona un tutor --</option>

          @foreach ($professors as $professor)
           <option value="{{ $professor->id }}">{{ $professor->nom }} {{ $professor->cognoms }}</option>
         @endforeach
       </select>

        
    </div>


    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Desar</button>
        <a href="{{ route('professor_list') }}" class="btn btn-dark">Cancel·lar</a>
    </div>
    </div>
</form>

	</div>
@endsection