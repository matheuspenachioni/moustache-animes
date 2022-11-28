@extends('base')

@section('content')

    <h2>{{ $anime->title }}</h2>

    <hr>

    <p> <strong>Synopsis: </strong>{{ $anime->synopsis }}</p>
    <p> <strong>Episodes: </strong>{{ $anime->episodes }}</p>
    <p> <strong>Source: </strong>{{ $anime->source }}</p>
    <p> <strong>Studio: </strong>{{ $anime->studio->name }}</p>

    <hr>

    <a href="{{ route('animes.index') }}">Back to home</a>
    
@endsection