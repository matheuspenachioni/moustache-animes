<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link rel="stylesheet" href="{{ asset('assets/style.css')}}">
    </head>
    <body>
    <div class="container">
        <header class="text-center">
            <img src="{{URL::asset('/assets/moustache-logo.png')}}" class="img-fluid rounded-start" alt="..." width="130" height="130">
        </header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark rounded-3">
            <div class="container-fluid">
                <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link {{{ Route::current()->getName() == 'animes.index' ? 'active' : '' }}}" href="{{ route('animes.index') }}">Animes</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{{ Route::current()->getName() == 'studios.index' ? 'active' : '' }}}" href="{{ route('studios.index') }}">Studios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{{ Route::current()->getName() == 'animes.create' ? 'active' : '' }}}" href="{{ route('animes.create') }}">New Anime</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{{ Route::current()->getName() == 'studios.create' ? 'active' : '' }}}" href="{{ route('studios.create') }}">New Studio</a>
                        </li>
                    </ul>
                </div>
                <div class="mx-auto order-0">
                    <a class="navbar-brand mx-auto" href="#">
                                Welcome back, 
                                <?php 
                                    $user = auth()->user()->name; print_r($user);
                                ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" href="#">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content mt-4">
            {{-- code injection here... --}}
            @yield('content')
        </div>
        <footer class="text-center">
            <small>Copyright &copy; Moustache Animes</small>
        </footer>
    </div>

    <script src="https://kit.fontawesome.com/f2866a4178.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>