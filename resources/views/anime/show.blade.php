@extends('base')

@section('content')

<div class=" row">
    <div class="col-md-4 mx-auto">
        <img src="{{ url("storage/{$anime->image}") }}" class="img-fluid rounded-start" alt="">
    </div>
    <div class="col">
        <h2>{{ $anime->title }}</h2>
        <p> <strong>Sinopse: </strong>{{ $anime->synopsis }}</p>
        <p> <strong>Episódios: </strong>{{ $anime->episodes }}</p>
        <p> <strong>Fonte: </strong>{{ $anime->source }}</p>
        <p> <strong>Estúdio: </strong>{{ $anime->studio->name }}</p>
        <ul class="nav justify-content-center">
            <li>
                <a href="{{ route('animes.index') }}" class="button-18">Voltar</a>
            </li> &nbsp;
            <li class="nav-item">
                <a class="button-18" href="{{ route('animes.edit', $anime->id) }}">Editar</a>
            </li> &nbsp;
            <li class="nav-item">
                <form action="{{ route('animes.destroy', $anime->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="button-18" type="submit" value="Deletar">
                </form>
            </li>
        </ul>
    </div>
</div>
    
@endsection