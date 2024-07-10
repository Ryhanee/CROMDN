@extends('layouts.layout1')
@section('title', 'Acceuil')
@section('content')
<div class="container">
   <script src="{{ asset('js/utilities.js') }}"></script>
   {{-- Formulaire de recherche --}}
   <form action="{{ route('searchAdvanced') }}" method="GET" class="row">
      @csrf
      <div class="col-md-6 firstlot">
         <div class="form-group row">
            <label for="nom" class=" col-form-label">Nom</label>
            <div class="col-sm-8">
               <input type="text"  name="nom" class="form-control" id="Nom" >
            </div>
         </div>
         <div class="form-group row">
            <label for="prenom" class=" col-form-label">Prénom</label>
            <div class="col-sm-8">
               <input type="text" name="prenom" class="form-control" id="prenom" placeholder="">
            </div>
         </div>
         <div class="form-group row">
            <label for="date-naissance" class=" col-form-label">Date de naissance</label>
            <div class="col-sm-8">
               <input type="date" name="date_naissance"class="form-control" id="date-naissance" placeholder="">
            </div>
         </div>
         <div class="form-group row">
            <label for="tel" class=" col-form-label">Mobile </label>
            <div class="col-sm-8">
               <input type="text" name="gsm" class="form-control" id="tel" placeholder="">
            </div>
         </div>
         <div class="form-group row">
            <label for="etat" class=" col-form-label">Etat</label>
            <div class="col-sm-8">
               <select class="form-control" name="etat" id="etat">
                  <option></option>
                  @foreach($type_etats as $type_etat)
                  <option value="{{$type_etat->id}}">{{$type_etat->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
          <div class="dateEtat d-none">
              <div class="form-group row">
                  <!-- date 1 -->
                  <label for="dateEtat1" class="col-form-label">Début état</label>
                  <div class="col-sm-3">
                      <select class="form-control" name="dateEtat1" id="dateEtat1">
                          <?php $now = date('Y'); ?>
                          @for ($i = 1990; $i <= $now; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                      </select>
                  </div>
                  <label for="dateEtat1" style="font-size: 1.1em!important; margin-right: 38px;">Fin état</label>
                  <div class="col-sm-3">
                      <select class="form-control" name="dateEtat2" id="dateEtat2">
                          <?php $now = date('Y'); ?>
                          @for ($i =1990; $i <= $now; $i++)
                          @if($i == $now )
                          <option value="{{ $i }}" selected>{{ $i }}</option>
                          @else
                          <option value="{{ $i }}">{{ $i }}</option>
                          @endif
                          @endfor
                      </select>
                  </div>
              </div>
          </div>
          <!-- fin etat -->


         <div class="form-group row">
            <label for="Gouvernorat" class="col-form-label">Gouvernorat</label>
            <div class="col-sm-8">
               <select class="form-control" name="gouvernorat" id="gouvernorat">
                  <option></option>
                  @foreach($gouvernorats as $gouvernorat)
                  <option value="{{$gouvernorat->id}}"> {{$gouvernorat->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>
      <div class="col-md-6 secondlot">
         <div class="form-group row">
            <label for="delegation" class=" col-form-label">Délégation</label>
            <div class="col-sm-8">
               <select class="form-control" name="delegation" id="delegation">
                  <option></option>
                  @foreach($delegations as $delegation)
                  <option value="{{$delegation->id}}"> {{$delegation->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="ville" class=" col-form-label">Localité</label>
            <div class="col-sm-8">
               <select class="form-control" name="ville" id="ville">
                  <option></option>
                  @foreach($villes as $ville)
                  <option value="{{$ville->id}}">{{$ville->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="adresse" class=" col-form-label">Adresse</label>
            <div class="col-sm-8">
               <input type="text" name="adresse" class="form-control" id="tel" placeholder="">
            </div>
         </div>
         <div class="form-group row">
            <label for="specialite" class="col-form-label">Specialité</label>
            <div class="col-sm-8">
               <select class="form-control" name="specialite" id="specialite">
                  <option></option>
                  @foreach($specialites as $specialite)
                  <option value="{{$specialite->id}}">{{$specialite->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="mode" class=" col-form-label">Mode d'éxercice</label>
            <div class="col-sm-8">
               <select class="form-control" name="mode" id="mode">
                  <option></option>
                  @foreach($modes as $mode)
                  <option value="{{$mode->id}}">{{$mode->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="type_exercice" class=" col-form-label">Type Mode d'exercice</label>
            <div class="col-sm-8">
               <select class="form-control" id="type_exercice" name="type_exercice" >
                  <option></option>
                  @foreach($type_exercices as $type_exercice)
                  <option value="{{$type_exercice->id}}">{{$type_exercice->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="sexe" class=" col-form-label col-sm-2">Genre</label>
            <div class="custom-control custom-radio custom-control-inline col-sm-2">
               <input type="radio" id="homme" name="sexe" value="1" class="custom-control-input">
               <label class="custom-control-label" for="homme">Homme</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline col-sm-2">
               <input type="radio" id="femme" name="sexe" value="0" class="custom-control-input">
               <label class="custom-control-label" for="femme">Femme</label>
            </div>
         </div>
      </div>
      <div class="col-md-12 block-sexe m-auto">
         <div class="form-group row justify-content-center">
         </div>
      </div>
      <div class="col-md-12 submit-center">
         <button type="submit" class="btn btn-primary btn-rechercher">Rechercher</button>
      </div>
   </form>
   {{-- fin du formulaire --}}
</div>
<script src="{{ asset('js/localite.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#etat').change(function() {
            if ($(this).val() !== "") {
                $('.dateEtat').removeClass('d-none').addClass('d-block');
            } else {
                $('.dateEtat').removeClass('d-block').addClass('d-none');
            }
        });
    });
</script>
@endsection
