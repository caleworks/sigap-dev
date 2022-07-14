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

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ url('assets/img/KODEL-Only_2021.png') }}" alt="Kodel Logo" width="72">
                                        <h1 class="h2 text-gray-900 mt-3">Kodel Group</h1>
                                        <h3 class="h5 text-gray-900 mb-4">Inventory Apps</h3>
                                    </div>
                                    <form class="user" method="post" action="{{ url('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="password" name="password" placeholder="Password" required>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <div class="text-center mt-2">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ url('') }}">Back to Homepage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>