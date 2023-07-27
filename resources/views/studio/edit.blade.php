@extends('base')

@section('content')
    <h2 class="text-center">Novo Estúdio</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('studios.update', $studio->id) }}">
            @csrf
            @method("PUT")
            <div class="mb-2 col-6 mx-auto">
                <label for="name" class="form-label fw-bold">➤ Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $studio->name }}">
                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="description" class="form-label fw-bold">➤ Descrição</label>
                <textarea type="text" class="form-control" name="description" id="description">{{ old('description') ? old('description') : $studio->description }}</textarea>
                @error('description')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="established" class="form-label fw-bold">➤ Criado em</label>
                <input type="input" class="form-control" name="established" id="established" value="{{ old('established') ? old('established') : $studio->established }}">
                @error('established')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="text-center my-4 col-12 mx-auto">
                <input type="submit" class="btn btn-outline-primary col-6 my-1" value="Salvar">
                <input type="reset" class="btn btn-outline-danger col-6 my-1" value="Limpar">
            </div>
        </form>
    </div>
@endsection