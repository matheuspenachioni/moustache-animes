@extends('base')

@section('content')
    <div class="row">
        <div class="col">
            <h2>{{ $status->name }}</h2>
            <p><strong>Description:</strong> {{ $status->description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('studios.edit', $studio->id) }}">Edit</a>
        </div>
    </div>
@endsection