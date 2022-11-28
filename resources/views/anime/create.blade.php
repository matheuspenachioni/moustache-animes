@extends('base')

@section('content')
    <h2 class="text-center">Register new anime</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('animes.store') }}" enctype="multipart/form-data">
            {{-- protection against cross-site request forgering --}}
            @csrf
            <div class="mb-2 col-6 mx-auto">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="synopsis" class="form-label fw-bold">Synopsis</label>
                <textarea type="text" class="form-control" name="synopsis" id="synopsis">{{ old('synopsis') }}</textarea>
                @error('synopsis')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="image" class="form-label fw-bold">Image:</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}">
                @error('image')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="episodes" class="form-label fw-bold">Episodes:</label>
                <input type="number" class="form-control" name="episodes" id="episodes" value="{{ old('episodes') }}">
                @error('episodes')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="source" class="form-label fw-bold">Source:</label>
                <input type="text" class="form-control" name="source" id="source" value="{{ old('source') }}">
                @error('source')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="studio" class="form-label fw-bold">Studio</label>
                <select class="form-select" name="studio" id="studio">
                    @if($studios)
                        @foreach ($studios as $studio)
                            <option value="{{$studio->id}}">{{ $studio->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="text-center my-4 col-6 mx-auto">
                <input type="submit" class="btn btn-outline-primary" value="Submit">
                <input type="reset" class="btn btn-outline-danger" value="Clear">
            </div>
        </form>
    </div>

    {{-- @if(count($errors) > 0)
        {{ dd($errors) }}
    @endif --}}

    {{-- @if($brands)
        {{ dd($brands) }}
    @endif --}}

@endsection