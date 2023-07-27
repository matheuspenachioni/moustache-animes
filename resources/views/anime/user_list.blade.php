@extends('base')

@section('content')
    <style>
        .card-img-top {
            height: 450px;
            object-fit: cover;
        }

        .card-title {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .anime-card {
            height: 100%;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Minha lista</h2>
                <h6 class="text-muted">Os <strong>animes</strong> que você adicionou aparecem aqui!</h6>
                <hr>
            </div>
            <div class="col-12 py-2">
                <form action="{{ route('animes.user_list.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquise um anime pelo nome..." value="{{ request()->query('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> &nbsp; Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 mb-3">
            @if ($animes->count() > 0)
                @foreach ($animes as $anime)
                    <div class="col">
                        <div class="card anime-card">
                            <div class="position-relative">
                                <img src="{{ url("storage/{$anime->image}") }}" class="card-img-top" alt="Capa do anime {{ $anime->title }}">
                                <div class="card-img-overlay d-flex flex-column justify-content-between text-white">
                                    <h3 class="card-title">{{ $anime->title }}</h3>
                                    <div>
                                        <span class="badge {{ $anime->statu->color }} mb-1" style="width:100%">{{ $anime->statu->name }}</span>
                                        <p class="m-0"><i class="fa fa-star text-warning"></i> {{ $anime->score }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('animes.update_watched', $anime->id) }}" method="post" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-check"></i></button>
                                            <input type="number" name="watched" id="watched" value="{{ $anime->pivot->watched }}" min="0" max="{{ $anime->episodes }}" class="form-control" style="width: 70px;">
                                            <span class="input-group-text bg-white border border-0" id="inputGroup-sizing-default">de {{ $anime->episodes }} episódios</span>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex mt-3">
                                    <a href="{{ route('animes.show', $anime->id) }}" class="btn btn-primary me-2" style="width: 49%">
                                        <i class="fa fa-circle-info"></i>
                                    </a>
                                    <a href="{{ url('/animes/remove/' . $anime->id) }}" class="btn btn-danger" style="width: 49%">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <form action="{{ route('animes.update_rating', $anime->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group">
                                        <label class="input-group-text bg-white border border-0" for="scoreInput">
                                            <i class="fa fa-star text-warning"></i> &nbsp; Nota:
                                        </label>
                                        <select class="form-select border border-0" name="rating" id="scoreInput" onchange="this.form.submit()">
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ $anime->pivot->rating == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="col-12" style="width: 100% !important;">
                <div class="alert alert-warning mt-2" role="alert">
                    @if( request()->query('search'))
                        Nenhum anime com "{{ request()->query('search') }}" foi encontrado!
                    @else
                        Sua lista está vazia
                    @endif
                </div>
            </div>
            @endif
        </div>
        {{ $animes->links('pagination::bootstrap-4') }}
    </div>
@endsection
