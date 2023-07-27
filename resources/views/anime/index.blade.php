@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Bem-vindo, {{ auth()->user()->name }}</h2>
                <h6 class="text-muted">Você pode adicionar <strong>animes</strong> em sua lista e marcar quantos episódios já assistiu.</h6>
                <hr>
            </div>
            <div class="col-12 py-2">
                <form action="{{ route('animes.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquise um anime pelo nome..." value="{{ request()->query('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> &nbsp; Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if ($animes->count() > 0)
                @foreach ($animes as $anime)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-99">
                            <img src="{{ url("storage/{$anime->image}") }}" class="card-img card-img-top" alt="Capa do anime {{ $anime->title }}">
                            <div class="card-img-overlay d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge {{ $anime->statu->color }} mb-1">{{ $anime->statu->name }}</span>
                                    <h4 class="text-white">{{ $anime->title }}</h4>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('animes.show', $anime->id) }}" class="btn btn-primary btn-round" style="width: 49%">
                                        <i class="fa fa-eye"></i>
                                    </a> &nbsp;
                                    <a href="{{ url('/animes/add/' . $anime->id) }}" class="btn btn-success btn-round" style="width: 49%">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning mt-2" role="alert">
                    Nenhum anime com "{{ request()->query('search') }}" foi encontrado!
                </div>
            @endif
        </div>
        {{ $animes->links('pagination::bootstrap-4') }}
    </div>
@endsection
