<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loading</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/maincss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css-interface.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">
    <script src="{{asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script> 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <style type="text/css">
        body{
            background-image: url("{{ asset('images/background.png') }}") ;

        }
    </style>
</head>
<body>
    <div class="container error-render">
        <div class="row">
            <div class="card text-white bg-danger col-md-8 m-auto">
                <div class="card-header">Erreur</div>
                <div class="card-body">
                    <h5 class="card-title">Une erreur est survenue !</h5>
                    <p class="card-text">Un problème est survenu.<br>
                    Veuillez réessayer ou contacter votre administrateur</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
