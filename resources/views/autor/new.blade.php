@extends('layout')

@section('title', 'Nou Autor')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nou Autor</h1>
    <a href="{{ route('autor_list') }}">&laquo; Torna</a>
    <ul style="color: red;">
        @error('nom')
            <li>{{ $message }}</li>
        @enderror
        @error('cognoms')
            <li>{{ $message }}</li>
        @enderror
    </ul>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('autor_new') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" />
            </div>
            <div>            
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms" />
            </div>
            <div>            
                <label for="imatge">Imatge</label>
                <input type="file" name="imatge" />
            </div>
            <button type="submit">Crear Autor</button>
        </form>
	</div>
@endsection