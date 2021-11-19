<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Scripts -->
 
   <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
</head>
<style>
    article {
    background: linear-gradient(90deg, rgba(85,49,27,1) 0%, rgba(238,217,188,1) 100%, rgba(95,56,56,1) 100%, rgba(236,236,236,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-align: center;
    }

    .logo1 h1 {
        font-size: 10vmin;
        line-height: 1.1;
        font-family: 'Source Code Pro', monospace;

    }
    .logo1 p {
    font-family: "Dank Mono", ui-monospace, monospace;
    }
</style>
<body>
    <div id="app">
        <topbar></topbar>
        <navbar></navbar>
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo" id="logo-text">
                        
                            <article class='logo1'>
                                <a href="/">
                                <h1>EBook</h1>
                                </a>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <form action="/search" type='get'>
                                <input type="text" placeholder="Search" name='value' id='val'>
                                <button type='submit'><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            @guest
                                    <a class="btn cart" href="{{ route('login') }}">{{ __('Login') }}</a>
                      
                                @if (Route::has('register'))
                                        <a class="btn cart" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                    <button class='btn cart'>
                                        <a href="{{ route('viewuser')}}" class='text-dark'>{{ Auth::user()->name }}</a>

                                            <a class="border" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                <i class="fas fa-power-off"></i>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                    </button>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
        <contact></contact>
        <footerlayout></footerlayout>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
