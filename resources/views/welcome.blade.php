<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajouter le token CSRF -->

    <title>Loading</title>
    @vite(['resources/js/app.js'])

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/maincss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css-interface.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">
    <script src="{{asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{asset('js/main-js.js') }}"></script>
    <script src="{{asset('js/my-custom.js') }}"></script>

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <style type="text/css">
        body{

            background-image: url("{{ asset('/images/background.png') }}") ;
        }
    </style>
    @auth
<input type="hidden" id="IdUser" value="{{Auth::user()->id}}">
@endauth
</head>
<body>


    <section class="titre-menu titre-menu-preload" id="preload">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><span class="titre-appli titre-preload">DENTY</span></h1>
                    <h6 class="bybusinessmania bybusinessmania-preload">by Business Mania</h6>

                </div>
                <div class="col-md-12 text-center loader-zone">
                    <div class="loader">
                        <img src="{{asset('images/preloader.png')}}">
                    </div>
                </div>
            </div>

        </div>
    </section>

 <script src="{{ asset('js/preload.js')}}"></script>

</body>
</html>
