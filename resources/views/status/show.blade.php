@extends('base')

@section('content')
    <div class=" row">
        <div class="col-md-4 mx-auto">
            <img src="{{ url("storage/{$studio->image}") }}" class="img-fluid rounded-start" alt="">
        </div>
        <div class="col">
            <h2>{{ $studio->name }}</h2>
            <p><strong>Description:</strong> {{ $studio->description }}</p>
            <p><strong>Established:</strong> {{ $studio->established }}</p>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('studios.edit', $studio->id) }}">Edit</a>
        </div>
    </div>
@endsection