@extends('layout')

@section('title', 'Crear un nou professor')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1 class="text-center">Nou Professor</h1>
    <div class="container d-flex justify-content-center">
	<div class="p-4 shadow rounded" style="max-width: 700px; width: 100%;">
       <form method="POST" action="{{ route('professor_edit' , $professor->id)}} " enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value= "{{ $professor->nom }}">
        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cognoms" class="form-label">Cognoms</label>
        <input type="text" name="cognoms" id="cognoms" class="form-control" value= "{{ $professor->cognoms }}">
        @error('cognoms')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value= "{{ $professor->email }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto (opcional)</label>
        <input type="file" name="foto" id="foto" class="form-control">
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Desar</button>
        <a href="{{ route('professor_list') }}" class="btn btn-dark">Cancel·lar</a>
    </div>
    </div>
</form>

	</div>
@endsection