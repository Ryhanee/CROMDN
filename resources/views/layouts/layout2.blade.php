<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Acceuil DENTY -@yield('title') </title>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.ico') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajouter le token CSRF -->

    {{------ CSS -------}}

<link rel="stylesheet" type="text/css" href="{{asset('css/maincss.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">

{{------ Javascript-------}}
<script src="{{asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{asset('js/main-js.js') }}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/utilities.js') }}"></script>
    <script src="{{asset('js/downloadLettres.js') }}"></script>

    {{------ API Maps -------}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCXTIjsqvdnQzFyLBDrUQb3h7TMvLxj1s8"></script>

{{--  GOOGLE FONTS

<link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

--}}


{{------  FONT AWESOME-------}}

<link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css') }}">
<style type="text/css">
body
{
	background-image: url("{{ asset('images/background.png') }}") ;
}
</style>
</head>

<body>
{{-- gestion des erreurs--}}

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
{{-- fin gestion erreurs --}}
{{-- section logo --}}
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
						{{--end of col--}}
						<div class="col">
							<input class="form-control form-control-lg form-control-borderless" type="search" placeholder='N° Inscription' name="numinscrit">
						</div>
						{{--end of col--}}
						<div class="col-auto">
							<button class="btn btn-lg btn-success" type="submit">Rechercher</button>
						</div>
						{{--end of col--}}
					</div>
				</form>
				{{--end of col--}}
			</div>

			<div class="col-md-4 nom-administrateur">
				<div class="row justify-content-end">
					<p class="nom-administrateur col-md-6">{{Auth::user()->prenom}} {{Auth::user()->nom}}</p>

					<div class="dropdown show" class="col-md-2">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-cogs"></i>
						</button>
						<a class="btn btn-primary" id="ajoutMedecin"
						href="{{ route('showCreateMedecin') }}"
						title="Ajout Médecin Dentiste">
						<i class="fas fa-user-plus"></i></a>

						@if (Route::has('login'))
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						    @auth
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


{{-- fin section logo--}}

{{-- section titre ou menu --}}



<section class="titre-menu">
<div class="container">
   <div class="row">
       <div class="col-md-12">
           <ul class="nav nav-pills nav-fill" id="nav">
<li class="nav-item {{ Request::segment(1) === 'search' ? 'active' : ''}}">
<a class="nav-link" href="{{ route('showMedecin',$medecin->id) }}"><i class="fas fa-user-md"></i>Profil</a>
</li>
<li class="nav-item {{ Request::segment(3) == 'etat' ? 'active' : ''}}">
<a class="nav-link" href="{{ route('showEtats',$medecin->id) }}"><i class="fas fa-bell"></i>Activité(s)</a>
</li>
<li class="nav-item {{ Request::segment(3) == 'cotisation' ? 'active' : ''}}">
<a class="nav-link" href="{{ route('showCotisations',$medecin->id) }}"><i class="fas fa-file-invoice-dollar"></i>Cotisations</a>
</li>
<li class="nav-item {{ Request::segment(3) == 'discipline' ? 'active' : ''}}">
<a class="nav-link" href="{{ route('showDisciplines',$medecin->id) }}"><i class="fas fa-balance-scale"></i>Disciplines</a>
</li>
<li class="nav-item {{ Request::segment(2) == 'plainte' ? 'active' : ''}}">
<a class="nav-link" href="{{ route('showPlaintes',$medecin->id) }}"><i class="fas fa-gavel"></i>Plaintes</a>
</li>
</ul>
       </div>
   </div>
</div>
</section>


{{--  finn section titre ou menu --}}

{{--   section numéro-inscription --}}
<section class="numero_inscription">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p class="info-inscri">Numéro d'Inscription : <span class="numero-inscri">{{ $medecin->id }}</span>
			</p>
			</div>
			<div class="col-md-6">
				<p class="info-inscri">Dr : <span class="numero-inscri">{{ $medecin->prenom }}</span> <span class="numero-inscri">{{ $medecin->nom }}</span>
			</p>
			</div>
		</div>
	</div>
</section>
{{--   section numéro-inscription --}}

{{--------------------------- Contenu variable ajouter -------------------}}

<section class="contenu1">

	@yield('content')
</section>

{{----------------------------- fin Contenu variable ajouter--------------- --}}



	{{-- ce layout est un layout pour information spécifique pour un medecin--}}
</body>



</html>
