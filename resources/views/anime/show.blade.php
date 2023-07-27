@extends('base')

@section('content')

<div class="row">
    <div class="col-md-3 mx-auto mb-2">
        <img src="{{ url("storage/{$anime->image}") }}" class="img-fluid rounded-start" alt="">
    </div>
    <div class="col-md-5">
        <div>
            <span class="h3">{{ $anime->title }}</span> 
            <br> 
            <span class="badge bg-primary">{{ $anime->statu->name }}</span>
            <i class="fa fa-star text-warning"></i> {{ $anime->score }}
        </div>
        <div class="mt-2">
            <strong>Sinopse: </strong> <br>
            <span>{{ $anime->synopsis }}</span>
        </div>
        <div class="mt-2">
            <strong>Episódios: </strong> {{ $anime->episodes }}
        </div>
        <div class="row mt-2">
            <div class="col-sm-6"> 
                <strong>Estúdio: </strong><a class="link-studio" href="{{ route('studios.show', $anime->studio->id) }}">{{ $anime->studio->name }}</a>
            </div>
            <div class="col-sm-6 text-sm-right">
                <strong>Fonte: </strong>{{ $anime->source }} 
            </div>
        </div>
        <ul class="nav justify-content-center mt-3">
            <li class="nav-item">
                <a href="{{ route('animes.index') }}" class="button-18 color-default">Voltar</a>
            </li>
            @if (Auth::user()->roles->contains('name', 'admin'))
                &nbsp;
                <li class="nav-item">
                    <a class="button-18 color-default" href="{{ route('animes.edit', $anime->id) }}">Editar</a>
                </li>
                &nbsp;<li class="nav-item">
                    <form action="{{ route('animes.destroy', $anime->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="button-18 color-remove" type="submit" value="Deletar">
                    </form>
                </li>
            @endif
        </ul>
    </div>
    <div class="col-md-4">
        <h3>Avaliações</h3>
        <hr>
        <form method="post" action="{{ isset($comment->id) ? route('comments.update', $comment->id) : route('animes.comments.store', $anime->id) }}">
            @csrf
            @if(isset($comment->id))
                @method('PATCH')
            @endif
            <label for="body">Deixe seu comentário:</label>
            <div class="input-group">
                <input name="body" id="body" class="form-control col-10" value="{{ $comment->body }}"/>
                <button type="submit" class="btn btn-primary col-2">
                    <i class="fa fa-send"></i>
                </button>
            </div>
        </form>
        <div class="comment-section overflow-auto mt-3" style="max-height: 450px;">
            @foreach($anime->comments as $comment)
                <div class="card border border-0 mb-3">
                    <div class="d-flex align-items-center">
                        <!-- Imagem do usuário -->
                        <img src="{{ url("storage/images/{$comment->user->avatar}") }}" class="rounded-circle" width="50" height="50" alt="">
        
                        <!-- Nome do usuário -->
                        <div class="mx-3 fw-bold">{{ $comment->user->name }}</div>
        
                        <!-- Opções do comentário -->
                        @if(auth()->user()->id == $comment->user_id)
                            <div class="ms-auto">
                                <button class="btn" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('comments.edit', $comment->id) }}">Editar</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('comments.delete', $comment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Excluir</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Texto do comentário -->
                    <p class="mt-2">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
    
@endsection