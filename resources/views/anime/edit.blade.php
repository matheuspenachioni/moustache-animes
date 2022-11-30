@extends('base')

@section('content')
    <h2 class="text-center">Updating anime</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('animes.update', $anime->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-2 col-6 mx-auto">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ? old('title') : $anime->title }}">
                @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="synopsis" class="form-label fw-bold">Synopsis</label>
                <textarea type="text" class="form-control" name="synopsis" id="synopsis">{{ old('synopsis') ? old('synopsis') : $anime->synopsis }}</textarea>
                @error('synopsis')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror 
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="image" class="form-label fw-bold">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @error('image')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror 
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="episodes" class="form-label fw-bold">Episodes</label>
                <input type="number" class="form-control" name="episodes" id="episodes" value="{{ old('episodes') ? old('episodes') : $anime->episodes }}">
                @error('episodes')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="source" class="form-label fw-bold">Source</label>
                <input type="text" class="form-control" name="source" id="source" value="{{ old('source') ? old('source') : $anime->source }}">

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
                            <option {{ $anime->studio_id == $studio->id ? 'selected' : ''  }}   
                                value="{{ $studio->id }}">{{ $studio->name }}</option>
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
@endsection