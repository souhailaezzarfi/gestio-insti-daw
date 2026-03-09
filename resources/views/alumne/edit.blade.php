@extends('layout')

@section('title', 'Edit alumne')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1 class="text-center">Edit Anumne</h1>
    <div class="container d-flex justify-content-center">
	<div class="p-4 shadow rounded" style="max-width: 700px; width: 100%;">
       <form method="POST" action="{{ route('alumne_edit', ['id' => $alumne->id]) }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ $alumne->nom }}">
        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cognoms" class="form-label">Cognoms</label>
        <input type="text" name="cognoms" id="cognoms" class="form-control" value="{{ $alumne->cognoms }}">
        @error('cognoms')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    

    <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="dni" name="dni" id="dni" class="form-control" value="{{ $alumne->dni }}">
        @error('dni')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

     <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value= "{{ $alumne->email }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="data_naixement" class="form-label">Data naixement</label>
        <input type="date" name="data_naixement" id="data_naixement" class="form-control" value="{{ $alumne->data_naixement }}">
        @error('data_naixement')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="telefon" class="form-label">Telèfon(opcional)</label>
        <input type="text" name="telefon" id="telefon" class="form-control" value="{{ $alumne->telefon }}">
    </div>

     <div class="mb-3">
        <label for="grup_id" class="form-label">Grup(opcional)</label>
        <select name="grup_id" class="form-control">
          <option value="">-- Sense grup --</option>

          @foreach ($grups as $grup)
           <option value="{{ $grup->id }}"  @if($alumne->grup_id == $grup->id) selected @endif> {{ $grup->nom }}</option>
          @endforeach
       </select> 
    </div>

    <div class="mb-3">
            <label for="">Matŕcula(mòduls i notes)</label><br>

               @foreach ($moduls as $modul)
               @php $pivot = $alumne->moduls->find($modul->id); @endphp
               <div class="form-check">
                <input type="checkbox" name="checked[{{ $modul->id }}]" value="{{ $modul->id }}" @if($alumne->moduls->contains($modul->id)) checked @endif> <label for="">{{ $modul->nom }} </label>
               <input class="ms-3" type="number" name="nota[{{ $modul->id }}]"  value="{{ $pivot ? $pivot->pivot->nota : '' }}">
               <label for="">Nota </label>
               </div>
               
              @endforeach
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Desar</button>
        <a href="{{ route('alumne_list') }}" class="btn btn-dark">Cancel·lar</a>
    </div>
    </div>
</form>

	</div>
@endsection