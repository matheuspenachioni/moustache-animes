<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link rel="stylesheet" href="{{ asset('style/style.css')}}">
    </head>
    <body>
    <div class="container">
        <header class="text-center">
            <img src="{{URL::asset('/assets/moustache-logo.png')}}" class="img-fluid rounded-start" alt="..." width="130" height="130">
        </header>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item"> <a class="nav-link" href="{{ route('animes.index') }}">Animes</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('animes.create') }}">New Anime</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('studios.create') }}">New Studio</a> </li>
            </ul>
        </nav>
        <div class="content mt-4">
            {{-- code injection here... --}}
            @yield('content')
        </div>
        <footer class="text-center">
            <small>© 2022 Moustache Animes</small>
        </footer>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>