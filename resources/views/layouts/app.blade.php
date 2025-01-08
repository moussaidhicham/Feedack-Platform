<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Feedback Platform') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- External CSS -->
    <link rel="stylesheet" href="path/to/your/css/style.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9; /* Gris clair */
            margin: 0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2c3e50; /* Bleu foncé */
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: #ecf0f1;
            transition: color 0.3s ease;
        }

        .navbar .navbar-brand:hover {
            color: #16a085; /* Vert menthe */
        }

        .navbar .nav-link {
            color: #ecf0f1 !important;
            font-weight: 500;
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar .nav-link:hover {
            background-color: #16a085;
            border-radius: 5px;
            color: white;
        }

        .navbar .dropdown-menu {
            background-color: #2c3e50;
            border: none;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0s 0.3s;
        }

        .navbar .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }

        .navbar .dropdown-item {
            color: #ecf0f1;
            padding: 12px 20px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar .dropdown-item:hover {
            background-color: #16a085;
            color: white;
            border-radius: 5px;
        }

        /* Button Logout */
        .navbar .dropdown-menu-end .dropdown-item {
            font-weight: 600;
            padding: 12px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar .dropdown-menu-end .dropdown-item:hover {
            color: white;
        }

        .navbar .dropdown-item.profil-item {
            background-color: #3498db;
            font-weight: 600;
        }

        .navbar .dropdown-item.profil-item:hover {
            background-color: #2980b9;
        }

        /* Mobile Toggler */
        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-color: #ecf0f1;
        }

        /* Main Content Area */
        main {
            padding: 2rem 0;
        }

        /* Form Inputs and Buttons */
        input, select, button {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, button:focus {
            border-color: #16a085;
            outline: none;
        }

        /* Navbar Spacing */
        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 20px;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #16a085;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('FeedBack-Platform', 'FeedBack-Platform') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(!auth()->check() || !auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/') }}">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/#propos') }}">À propos</a>
                            </li>
                        @endif
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('feedbacks.index') }}">Gestion des Feedbacks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('admin.index') }}">Gestion des cours</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('profile.edit') }}">Mon Profil</a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mon Profil</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Déconnexion</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3">
            <div class="container">
                <p>&copy; {{ date('Y') }} {{ config('Feedback Platform', 'Feedback Platform') }}. Tous droits réservés.</p>
                <p><a href="{{ url('/privacy-policy') }}" class="text-white">Politique de confidentialité</a> | <a href="{{ url('/terms-of-service') }}" class="text-white">Conditions d'utilisation</a></p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
