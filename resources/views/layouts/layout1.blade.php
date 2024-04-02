<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <title> DENTY -@yield('title') </title>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.ico') }}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{------ API Maps -------}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCXTIjsqvdnQzFyLBDrUQb3h7TMvLxj1s8"></script>


        <!------  GOOGLE FONTS------->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
        <!------  FONT AWESOME------->
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css') }}">
         <!------   CSS------->
        <link rel="stylesheet" type="text/css" href="{{asset('css/maincss.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">

         <!------  js------->
        
       <script src="{{asset('js/jquery-3.4.1.min.js') }}"></script>
       <script src="{{asset('js/main-js.js') }}"></script>
       <script src="{{asset('js/popper.min.js')}}"></script> 

       <script src="{{asset('js/bootstrap.min.js')}}"></script>
       <script src="{{ asset('js/utilities.js') }}"></script>
          
        <style type="text/css">
            body{

    background-image: url("{{ asset('images/background.png') }}") ;

}
        </style>

</head>

<body>

    <!-- gestion des erreurs-->
@if($errors->any())
<section class="gestion-erreur slide-in-top">
<div class="container">
         <div class="row alerts-errors">
           <div class="col-md-12">
             <div class="card text-white bg-warning">
 <div class="card-body">
   <p class="card-text">{{$errors->first()}}</p>
 </div>
</div>
           </div>
           </div>
         </div>
       </section>
@endif

<!-- fin gestion des erreurs-->

<!-- section logo-->
@if (Route::has('login'))
@auth
        <section id="logo-top">
            <div class="container">
                <div class="row">
                    
                  <div class="col-md-4 logo">
        <a href="{{ route('showIndex') }}">
        <img src="{{ asset('images/logo.png') }}"></a>
      </div>
                    <div class="col-md-4 search">
                        
                            <form class="card card-sm" action="{{ route('searchSimple') }}" method="post">
                                 @csrf
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder='N° Inscription' name="numinscrit">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit">Rechercher</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        <!--end of col-->
                    </div>

                    <div class="col-md-4 nom-administrateur">
                        <div class="row justify-content-end">
                        <p class="nom-administrateur col-md-6">{{Auth::user()->prenom}} {{Auth::user()->nom}}</p>

                        <div class="dropdown show" class="col-md-2">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <i class="fas fa-cogs"></i>
  </button>
 <a class="btn btn-info" id="ajoutMedecin" href="{{ route('showCreateMedecin') }} " title="Ajout Médecin Dentiste"><i class="fas fa-user-plus"></i></a>
 


  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    
    <a class="dropdown-item" href="{{ route('showIndex') }}"><i class="fas fa-search-plus fa-sm"></i>Recherche</a>
    <a class="dropdown-item" href="{{ route('showSearchCotisation') }}"><i class="fas fa-search-dollar"></i>Cotisation</a>  
    <a class="dropdown-item" href="{{ route('showParametre') }}"><i class="fas fa-cogs"></i>Paramètres</a>
    
    <a class="dropdown-item"  href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
    
  </div>
  @endauth
  
  @endif
        </div>
      </div>
     </div>            
    </div>
  </div>
</section>

        <!--  fin section logo-->
 <!-- section titre ou menu -->
    <section class="titre-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1> <span class="Bienvenue">Bienvenue dans</span> <span class="titre-appli">DENTY</span></h1>
                    <h6 class="bybusinessmania">by Business Mania</h6>
                    
                </div>
            </div>
            
        </div>  
    </section>
     <!--fin section titre ou menu -->

      <!--------------------------- Contenu variable ajouter ------------------->

    <section class="contenu1">
@yield('content')
    </section>
     <!---------------------------  fin Contenu variable ajouter ------------------->
<section class="copyrights">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
    <p class="copyrights">&copy; 
        <script type="text/javascript">
var ladate=new Date()
document.write(ladate.getFullYear())
</script>

     Business Mania</p>

                
            </div>
            
        </div>
        
    </div>

</section>

<!-- ce layout est un layout générique -->

  </body>


</html>