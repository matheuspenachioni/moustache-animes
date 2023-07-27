@extends('base')

@section('content')
    <div class="row mb-2">
        <div class="col-md-4 mx-auto">
            <img src="{{ url("storage/{$studio->image}") }}" class="img-fluid rounded-start" alt="">
        </div>
        <div class="col">
            <h3>{{ $studio->name }}</h3>
            <hr>
            <div>
                <strong>Descrição:</strong> <br>
                <span>{{ $studio->description }}</span>
            </div>
            <div class="mt-2">
                <strong>Criado em:</strong> <br>
                 <span>{{ $studio->established }}</span>
            </div>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="{{ route('studios.index') }}" class="button-18 color-default">Voltar</a>
                </li> 
                @if (Auth::user()->roles->contains('name', 'admin'))
                    &nbsp;
                    <li class="nav-item">
                        <a class="button-18 color-default" href="{{ route('studios.edit', $studio->id) }}">Editar</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <form action="{{ route('studios.destroy', $studio->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="button-18 color-remove" type="submit" value="Deletar">
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endsection