@extends('layout')

@section('title', 'Edit un modul')

@section('stylesheets')
    @parent
@endsection
 
@section('content')
    <h1 class="text-center">Edit mòdul</h1>
    <div class="container d-flex justify-content-center">
	<div class="p-4 shadow rounded" style="max-width: 700px; width: 100%;">
       <form method="POST" action="{{ route('modul_edit' , $modul->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value= "{{ $modul->nom }}">
        
    </div>

    <div class="mb-3">
        <label for="hores" class="form-label">Aula</label>
        <input type="number" name="hores" id="hores" class="form-control" value= "{{ $modul->hores }}">
        
    </div>
    

    <div class="mb-3">
        <label for="professor_id" class="form-label">Professor(opcional)</label>
        <select name="professor_id" class="form-control">
          <option value="">-- Sense professor --</option>

          @foreach ($professors as $professor)
           <option value="{{ $professor->id }}" @selected($modul->professor_id == $professor->id)>{{ $professor->nom }} {{ $professor->cognoms }}</option>
         @endforeach
       </select>

        
    </div>


    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Desar</button>
        <a href="{{ route('modul_list') }}" class="btn btn-dark">Cancel·lar</a>
    </div>
    </div>
</form>

	</div>
@endsection