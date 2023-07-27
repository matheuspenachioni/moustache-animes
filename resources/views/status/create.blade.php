@extends('base')

@section('content')
    <h2 class="text-center">Novo Status</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('status.store') }}">
            {{-- protection against cross-site request forgering --}}
            @csrf
            <div class="mb-2 col-6 mx-auto">
                <label for="name" class="form-label fw-bold">➤ Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="color" class="form-label fw-bold">➤ Cor</label>
                <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}">
                @error('color')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="description" class="form-label fw-bold">➤ Descrição</label>
                <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
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