@extends('base')

@section('content')
    <div class=" text-center">
        <h2>{{ $studio->name }}</h2>
        <h4>{{ $studio->description }}</h4>
        <h4>{{ $studio->established }}</h4>

        <div class="col-md-4 mx-auto">
            <img src="{{ URL::to('/' . $studio->image) }}" class="img-fluid rounded-start" alt="">
        </div>
    </div>
    <a href="{{ route('animes.index') }}">Back to home</a>
@endsection