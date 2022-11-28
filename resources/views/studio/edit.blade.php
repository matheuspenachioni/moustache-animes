@extends('base')

@section('content')
    <h2 class="text-center">Register new studio</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('studios.update', $studio->id) }}">
            @csrf
            @method("PUT")
            <div class="mb-2 col-6 mx-auto">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $studio->name }}">
                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="text-center my-4 col-6 mx-auto">
                <input type="submit" class="btn btn-outline-primary" value="Submit">
                <input type="reset" class="btn btn-outline-danger" value="Clear">
            </div>
        </form>
    </div>
    {{ dd($studio) }}
@endsection