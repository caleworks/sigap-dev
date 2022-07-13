<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | Inventory Kodel Group</title>
    
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('assets/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('assets/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('assets/favicon/ms-icon-144x144.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('frontpage/css/styles.css')}}" rel="stylesheet" />

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

</head>
<body>
    <div id="app">

        <!-- Responsive navbar-->
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
              <a href="{{ url('/') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img class="bi me-2 mt-2" height="37.6" role="img" src="{{ url('assets/img/KODEL-Only_2021.png') }}" alt="">
                <h5 class="d-none d-xl-block mt-3">Kodel Group</h5>
              </a>
              <div class="text-end">
                @guest
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                @else
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <i class="fas fa-fw fa-user"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                                </form>
                              </li>
                            </ul>
                        </li>
                    </ul>
                @endguest
              </div>
            </header>
        </div>
        <main>
            @yield('search_public')
        </main>
    </div>
    <!-- Footer-->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{url('frontpage/js/scripts.js')}}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
