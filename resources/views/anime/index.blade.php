{{-- inherit from view base --}}
@extends('base')

{{-- create a section to specific code --}}
@section('content')
    @if (!is_null($animes))
        <div class="row mx-auto">
            @foreach ($animes as $anime)
                <div class="card card-maior col-lg-6 col-sm-12 mx-auto my-4 px-0" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ URL::to('/' . $anime->image) }}" class="img-fluid img-banner rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $anime->title }}</h5>
                                <hr>
                                <p class="card-text">Episodes..: {{ $anime->episodes }}</p>
                                <p class="card-text">Source.....: {{ $anime->source }}</p>
                                <p class="card-text ">Studio.....: <a
                                     class="link-studio" href="{{ route('studios.show', $anime->studio->id) }}">{{ $anime->studio->name }}</a></p>
                                <p class="card-text">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <small class="text-primary"><a href="{{ route('animes.show', $anime->id) }}"
                                                class="btn btn-outline-info">View more</a></small>
                                    </li>&nbsp;
                                    <li class="nav-item">
                                        <small class="text-primary"><a href="{{ route('animes.edit', $anime->id) }}"
                                                class="btn btn-outline-primary">Edit</a></small>

                                    </li>&nbsp;
                                    <li class="nav-item">
                                        <small class="text-primary">
                                            {{-- form to delete the resource --}}
                                            <form action="{{ route('animes.destroy', $anime->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-outline-danger" type="submit" value="Delete">
                                            </form>
                                        </small>
                                    </li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        {{-- creating the links to pagination --}}
        <div class="row">
            {{ $animes->links('pagination::bootstrap-5') }}
        </div>
    @else
        <h3>No anime was found!</h3>
    @endif

@endsection