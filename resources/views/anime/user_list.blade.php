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
                        <img src="{{ url("storage/{$anime->image}") }}" class="img-fluid img-banner rounded-start" alt="Capa do anime {{ $anime->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <h5 class="card-title text-center">{{ $anime->title }}</h5>
                                <p class="text-center">
                                    <span class="badge {{ $anime->statu->name == 'Completo' ? 'text-bg-success' : 'text-bg-secondary'}}" href="">{{ $anime->statu->name }}</span>
                                </p>
                                <p class="card-text">
                                    <a href="{{ url('/animes/decrement/' . $anime->id) }}" class="{{ $anime->watched == 0 ? 'disabled-link' : ''}}"><i class="fa-solid fa-circle-minus text-danger"></i></a> 
                                    <span class="fw-bold">{{ $anime->watched }} </span>
                                    <a href="{{ url('/animes/increment/' . $anime->id) }}" class="{{ $anime->watched == $anime->episodes ? 'disabled-link' : ''}}"><i class="fa-solid fa-circle-plus text-primary"></i></a> 
                                    de <span class="fw-bold">{{ $anime->episodes }}</span> episódios assistidos
                                </p>
                                <p class="card-text">
                                    Estúdio: <a class="link-studio" href="{{ route('studios.show', $anime->studio->id) }}">{{ $anime->studio->name }}</a>
                                </p>
                                <p class="card-text">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <small class="text-primary"><a href="{{ route('animes.show', $anime->id) }}"
                                                class="button-18">Detalhes</a></small>
                                    </li>
                                </ul>
                                <a href="{{ url('/animes/remove/' . $anime->id) }}">Remover da minha lista</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
    @else
        <h3>No anime was found!</h3>
    @endif

@endsection
