<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Denty -login</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.ico') }}"/>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">

  <!-- Styles -->


  <link rel="stylesheet" type="text/css" href="{{ asset('css/maincss.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/css-interface.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

  <!-- jQuery ,  Popper.js,  Bootstrap JS -->
    <script src="{{asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{asset('js/main-js.js') }}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script> 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <style type="text/css">
    body{
      background-image: url("{{ asset('images/background.png') }}") ;
    }
  </style>

</head>
<body>

  <section class="interface-logo">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <img src="{{asset('images/logo.png')}}">

        </div>

      </div>
    </div>

  </section>

  @if($errors->any())
  <section class="gestion-erreur">
    <div class="container">

      <div class="row alerts-errors">
        <div class="col-md-12">
          <div class="alert alert-danger" role="alert"  class="close" data-dismiss="alert" aria-label="Close">
            {{$errors->first()}}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">

    $('.gestion-erreur').fadeOut(100);


  </script>
  @endif

  <section class="interface-login">

    <div class="wrapper fadeInDown">
      <div id="formContent">

        <!-- Login Form -->
        <form method="POST" action="{{ route('handleLogin') }}">
          @csrf
          <input type="text" id="email" class="fadeIn second" name="email" placeholder="login">
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="Mot de passe">
          <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

      </div>
    </div>

  </section>

</body>
</html>