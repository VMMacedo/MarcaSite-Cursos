<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="{{ asset('css/principal/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }} - @yield('title')</title>
</head>

<body>
    <header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"> <i class="fas fa-graduation-cap"></i>
            {{ config('app.name') }}</a>
        <button class="navbar-toggler  d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="btn-group">
            <a href="#"
                class="d-flex align-items-center justify-content-center pe-4 link-light text-decoration-none dropdown-toggle"
                id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}

            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end menu-user">
                <li>
                    <a class="dropdown-item text-muted disabled"> {{ __('Manage Account') }}</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user-circle"></i>
                        {{ __('Profile') }}</a></li>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <li>
                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </a>
                    </li>
                @endif
                <div class="border-t border-gray-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                        </a>
                    </li>
                </form>

            </ul>
        </div>

    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                        MarcaSite Cursos
                    </h6>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link
                            @if (Route::currentRouteName() == 'dashboard')
                                <?= 'active' ?>
                            @endif
                             nav-link-menu"
                                aria-current="page" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                            @if (Route::currentRouteName() == 'inscricao.index')
                                <?= 'active' ?>
                            @endif
                            nav-link-menu"
                                href="{{ route('inscricao.index') }}">
                                <i class="fas fa-graduation-cap"></i>
                                Inscrições
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link 
                            @if (Route::currentRouteName() == 'cursos.index')
                                <?= 'active' ?>
                            @endif
                            nav-link-menu"
                                href="{{ route('cursos.index') }}">
                                <i class="fas fa-university"></i>
                                Cursos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  
                            @if (Route::currentRouteName() == 'users.index')
                                <?= 'active' ?>
                            @endif
                                 nav-link-menu"
                                href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i>
                                Usuários
                            </a>
                        </li>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                        PAGSEGURO
                    </h6>
                    <ul class="nav flex-column mb-4">
                        <li class="nav-item">
                            <a class="nav-link
                            @if (Route::currentRouteName() == 'gateway.index')
                                <?= 'active' ?>
                            @endif
                             nav-link-menu"
                                aria-current="page" href="{{ route('gateway.index') }}">
                                <i class="fas fa-key"></i>
                                Token
                            </a>
                        </li>
                        
                    </ul>

                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h5">@yield('ContentTitle')</h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

    <script src="{{ asset('js/principal/script.js') }}"></script>



    @yield('scripts')
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
