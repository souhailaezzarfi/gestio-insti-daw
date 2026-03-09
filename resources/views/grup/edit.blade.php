@extends('layout')

@section('title', 'Edit un grup')

@section('stylesheets')
    @parent
@endsection
 
@section('content')
    <h1 class="text-center">Edit grup</h1>
    <div class="container d-flex justify-content-center">
	<div class="p-4 shadow rounded" style="max-width: 700px; width: 100%;">
       <form method="POST" action="{{ route('grup_edit' , $grup->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value= "{{ $grup->nom }}">
        
    </div>

    <div class="mb-3">
        <label for="aula" class="form-label">Aula</label>
        <input type="text" name="aula" id="aula" class="form-control" value= "{{ $grup->aula }}">
        
    </div>
    

    <div class="mb-3">
        <label for="professor_id" class="form-label">Tutor(Professor)</label>
        <select name="professor_id" class="form-control">
          <option value="">-- Selecciona un tutor --</option>

          @foreach ($professors as $professor)
           <option value="{{ $professor->id }}" @selected($grup->professor_id == $professor->id)>{{ $professor->nom }} {{ $professor->cognoms }}({{ $professor->email }})</option>
         @endforeach
       </select>

        
    </div>


    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Desar</button>
        <a href="{{ route('grup_list') }}" class="btn btn-dark">Cancel·lar</a>
    </div>
    </div>
</form>

	</div>
@endsection