@extends('layout')

@section('title', 'Editar Autor')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Autor</h1>
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
        <form method="POST" action="{{ route('autor_edit', ['id' => $autor->id]) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="{{ $autor->nom }}" />
            </div>
            <div>            
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms" value="{{ $autor->cognoms }}" />
            </div>
            @if ($autor->imatge != null)
            <div>   
            <span>Imatge actual: <strong>{{ $autor->imatge }}</strong></span>
            </div>
            <div>       
                <label for="delimatge">Eliminar imatge</label>
                <input type="checkbox" name="delimatge" />
            </div>
            @endif
            <div>            
                <label for="imatge">Imatge</label>
                <input type="file" name="imatge" />
            </div>
            <button type="submit">Editar Autor</button>
        </form>
	</div>
@endsection