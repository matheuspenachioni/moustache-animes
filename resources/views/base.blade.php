<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/style.css')}}">
    </head>
    <body class="bg-dark d-flex flex-column min-vh-100">
        <div class="container bg-white">
            <header class="text-center"></header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('animes.index') }}">
                        <span class="ms-2">Moustache Animes</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link {{{ Route::current()->getName() == 'animes.user_list' ? 'active' : '' }}}" href="{{ route('animes.user_list') }}">Minha lista</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link {{{ Route::current()->getName() == 'animes.index' ? 'active' : '' }}}" href="{{ route('animes.index') }}">Animes</a>
                            </li>
                        @if(Auth::user()->roles->contains('name', 'admin'))
                            <li class="nav-item active">
                                <a class="nav-link {{{ Route::current()->getName() == 'studios.index' ? 'active' : '' }}}" href="{{ route('studios.index') }}">Estúdios</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link {{{ Route::current()->getName() == 'status.index' ? 'active' : '' }}}" href="{{ route('status.index') }}">Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ Route::current()->getName() == 'animes.create' ? 'active' : '' }}}" href="{{ route('animes.create') }}">Novo Anime</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ Route::current()->getName() == 'studios.create' ? 'active' : '' }}}" href="{{ route('studios.create') }}">Novo Estúdio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ Route::current()->getName() == 'status.create' ? 'active' : '' }}}" href="{{ route('status.create') }}">Novo Status</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                            <img src="{{ url("storage/images/" . auth()->user()->avatar) }}" class="rounded-circle" width="50" height="50" alt="">
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php $user = auth()->user()->name; print_r($user); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                              <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link dropdown-item text-white" style="text-decoration: none;" href="#">
                                        <i class="fa-solid fa-right-from-bracket"></i> Sair
                                    </button>
                                </form>
                              </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="content mt-4">
                {{-- code injection here... --}}
                @yield('content')
            </div>
        </div>
        
        <footer class="mt-auto text-light text-center py-2">
            <small>Copyright &copy; Moustache Animes</small>
        </footer>

    <script src="https://kit.fontawesome.com/f2866a4178.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Toastr Config -->
    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
            "toastClass": "toastr-notification",
            "progressBar": "true",
            "closeButton": "true",
            "timeOut": "5000",
        };
    
        @if(session('success'))
            toastr.success("{{ session('success') }}", "Sucesso");
        @endif
    
        @if(session('error'))
            toastr.error("{{ session('error') }}", "Erro");
        @endif
    </script>
    <!-- DataTables -->
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"></script>
    <script>
        $(document).ready(function () {
            $('#tabelaStatus').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });

        $(document).ready(function () {
            $('#tabelaStudios').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });
    </script>
</body>
</html>