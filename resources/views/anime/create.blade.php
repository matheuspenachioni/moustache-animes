@extends('base')

@section('content')
    <h2 class="text-center">Novo Anime</h2>
    <hr>
    <form class="row g-3" method="POST" action="{{ route('animes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 col-5 mx-auto">
            <label for="title" class="form-label fw-bold">➤ Título</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-5 mx-auto">
            <label for="image" class="form-label fw-bold">➤ Imagem</label>
            <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}">
            @error('image')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-11 mx-auto">
            <label for="synopsis" class="form-label fw-bold">➤ Sinopse</label>
            <textarea type="text" class="form-control" name="synopsis" id="synopsis">{{ old('synopsis') }}</textarea>
            @error('synopsis')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-3 mx-auto">
            <label for="score" class="form-label fw-bold">➤ Nota</label>
            <input type="number" class="form-control" name="score" id="score" value="{{ old('score') }}" step="0.01">
            @error('score')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-3 mx-auto">
            <label for="episodes" class="form-label fw-bold">➤ Episódios</label>
            <input type="number" class="form-control" name="episodes" id="episodes" value="{{ old('episodes') }}">
            @error('episodes')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-3 mx-auto">
            <label for="source" class="form-label fw-bold">➤ Fonte</label>
            <input type="text" class="form-control" name="source" id="source" value="{{ old('source') }}">
            @error('source')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2 col-5 mx-auto">
            <label for="studio" class="form-label fw-bold">➤ Estúdio</label>
            <select class="form-select" name="studio" id="studio">
                @if ($studios)
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-2 col-5 mx-auto">
            <label for="statu" class="form-label fw-bold">➤ Status</label>
            <select class="form-select" name="statu" id="statu">
                @if ($status)
                    @foreach ($status as $statu)
                        <option value="{{ $statu->id }}">{{ $statu->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="text-center my-4 col-12 mx-auto">
            <input type="submit" class="btn btn-outline-primary col-6 my-1" value="Salvar">
            <input type="reset" class="btn btn-outline-danger col-6 my-1" value="Limpar">
        </div>
    </form>
    </div>

    {{-- @if (count($errors) > 0)
        {{ dd($errors) }}
    @endif --}}

    {{-- @if ($brands)
        {{ dd($brands) }}
    @endif --}}

@endsection
