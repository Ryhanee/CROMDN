@extends('layouts.layout1')
@section('title', 'Editer Asministrateur')
@section('content')
<div class="container">
  <div class="row">
    <div class="title col-md-12">
      <h3>Editer Administrateur</h3> 
    </div>
  </div>
  {{-- Formulaire update user --}}
  <form class="row" action="{{ route('updateUser',$user->id) }}" method="post">
    @csrf
    <div class="col-md-12 lot-center1">
      <div class="form-group row justify-content-center">
        <label for="nom" class="col-form-label text-center">Nom <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="text" name="nom" class="form-control" id="Nom" value="{{ $user->nom }}">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="prenom" class="col-form-label text-center">Prénom <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="text" name="prenom" class="form-control" id="prenom" placeholder=""  value="{{ $user->prenom }}">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-form-label text-center">Email <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="email" name="email" class="form-control" id="email" placeholder="" value="{{ $user->email }}">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="mot-de-passe" class="col-form-label text-center">Mot de passe <span class="obligatoire"> *</span></label>
        <div class="col-sm-4">
          <input type="password" name="password"class="form-control" id="password" placeholder="">
        </div>        
      </div>

      <div class="form-group row justify-content-center">
            <label for="confirm_password" class="col-form-label text-center">Confirmer password <span class="obligatoire"> *</span></label>
            <div class="col-sm-4">
              <input type="password" id="confirm_password" name="confirm_password" class="form-control">
            </div>
          </div>

       <div id="info_password" class="col-md-4 info-pass">
          <p>Votre mot de passe doit contenir :
            <br>- Au minimum 8 caractères.
            <br>- Au moins 1 majuscule.
            <br>- Au moins 1 minuscule.
            <br>- Au moins chiffre.
          </p>       
      </div>
    </div>
    <div class="col-md-4 submit-center-password">
      <button type="submit" class="btn btn-primary">Editer</button>
      <a href="{{route('showUsers')}}" class="btn btn-danger btn-rechercher">Retour </a>
    </div>
  </form> 
  {{-- fin  Formulaire update user --}}
</div>
<script src="{{asset('js/password.anim.js') }}"></script>
<script src="{{ asset('js/password.js')}}"></script>
@endsection