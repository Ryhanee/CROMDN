@extends('layouts.layout1')
@section('title', 'Profile Administrateur')
@section('content')
<div class="container">
    <div class="row">
        <div class="title col-md-12">
            <h3>Profil Administrateur</h3> 
        </div>                
    </div>
    <div class="row profile-user">
        <div class="col-md-12 first-lot1">
            <p class="Nom">Nom : <span class="resultat">{{$user->nom }}</span></p>
            <p class="prenom">Prénom : <span class="resultat">{{$user->prenom }}</span></p>
            <p class="cin">Email : <span class="resultat">{{$user->email }}</span></p>
        </div>
    </div>
    <div class="row reset-password">                   
        @if (Route::has('login'))
        <div class="col-md-12">
            @auth
            @if(Auth::user()->id_role==2)            
            <a href="{{route('showParametre')}}" class="btn btn-danger btn-rechercher">Retour </a>
            @elseif(Auth::user()->id_role==1 && $user->id != Auth::user()->id )
            <a href="{{route('showUsers')}}" class="btn btn-danger btn-rechercher">Retour </a>
            @elseif(Auth::user()->id_role==1 && $user->id == Auth::user()->id)
            <a href="{{route('showParametre')}}" class="btn btn-danger btn-rechercher">Retour </a>
            @endif
            <a href="{{ route('showResetPassword') }}" class="btn btn-primary">Reset Password</a>
            @endauth            
        </div>
        @endif

    </div>
</div>
@endsection