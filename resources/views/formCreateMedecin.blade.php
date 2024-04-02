@extends('layouts.layout1')
@section('title', 'Creation medecin')
@section('content')
<div class="container">
   <div class="row">
      <div class="title col-md-12">
         <h3>Ajouter Médecin Dentiste</h3>
      </div>
   </div>
   <script src="{{ asset('js/utilities.js') }}"></script>
   {{-- Formulaire d'ajout --}}
   <form class="row" action="{{ route('createMedecin') }}" method="POST">
      @csrf
      <div class="col-md-6 firstlot">
         <div class="form-group row">
            <label for="num_inscerit" class=" col-form-label">Numéro d'inscription<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="number"  class="form-control" id="num_inscerit" placeholder="Numéro d'inscription" name="num_inscerit" min="1" value="{{old('num_inscerit')}}" required>
               @error('id')
               <p style="color:brown;"><i class="fas fa-exclamation-circle"></i> {{$message}}</p>
               @enderror
            </div>
         </div>
         <div class="form-group row">
            <label for="date-inscription" class=" col-form-label">Date inscription<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="date" class="form-control" id="date_inscrit" name="date_inscrit" value="{{old('date_inscrit')}}" required>
               @error('date')
               <p style="color:brown;"><i class="fas fa-exclamation-circle"></i> {{$message}}</p>
               @enderror
            </div>
         </div>
         <div class="form-group row">
            <label for="nom" class=" col-form-label">Nom<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="text"  class="form-control" id="nom" name="nom" value="{{ old('nom') }}"required>
            </div>
         </div>
         <div class="form-group row">
            <label for="prenom" class=" col-form-label">Prénom<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="prenom" placeholder="" name="prenom" value="{{ old('prenom') }}" required>
            </div>
         </div>
         <div class="form-group row">
            <label for="date_naissance" class=" col-form-label">Date de naissance<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="date" class="form-control" id="date_naissance" placeholder="" name="date_naissance" value="{{ old('date_naissance') }}" required>
            </div>
         </div>
         <div class="form-group row">
            <label for="lieu_naissance" class=" col-form-label">lieu de naissance</label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="lieu_naissance" placeholder="" name="lieu_naissance" value="{{ old('lieu_naissance') }}">
            </div>
         </div>
         <div class="form-group row">
            <label for="email" class=" col-form-label">Email<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="email"  class="form-control" id="email"  name="email" value="{{ old('email') }}" required>
            </div>
         </div>
         <div class="form-group row">
            <label for="gsm" class=" col-form-label">Mobile<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="gsm" placeholder="Numéro de téléphone (8 chiffres)" pattern="[0-9]{8}" name="gsm" value="{{ old('gsm') }}" required>
            </div>
         </div>
         <div class="form-group row">
            <label for="fixe" class=" col-form-label">Autres numéros</label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="fixe" placeholder="" name="fixe" value="{{ old('fixe') }}">
            </div>
         </div>
         <div class="form-group row">
            <label for="site_web" class=" col-form-label">Site web</label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="site_web" placeholder="" name="site_web" value="{{ old('site_web') }}">
            </div>
         </div>

         <div class="form-group row">
            <label for="nationalite" class=" col-form-label">Nationalité<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" id="nationalite" name="nationalite" value="{{ old('nationalite') }}"required>
                  <option selected></option>
                  @foreach($nationalites as $nationalite)
                  <option value="{{$nationalite->id}}"{{ old('nationalite')==$nationalite->id ? 'selected' :($nationalite->id == 2 ? 'selected': '') }}> {{$nationalite->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>

      </div>
      <div class="col-md-6 secondlot">

         <div class="form-group row">
            <label for="gouvernorat" class=" col-form-label">Gouvernorat<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" id="gouvernorat" name="gouvernorat" required>
                  <option></option>
                  @foreach($gouvernorats as $gouvernorat)
                  <option  value="{{$gouvernorat->id}}"{{ old('gouvernorat')==$gouvernorat->id ? 'selected' : ''  }}> {{$gouvernorat->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="adresse" class=" col-form-label">Délégation<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" name="delegation" id="delegation" required>
                  <option ></option>
                  @foreach($delegations as $delegation)
                  <option  value="{{$delegation->id}}"{{ old('delegation')==$delegation->id ? 'selected' : ''  }}> {{$delegation->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="ville" class="col-form-label">Localité<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" name="ville" id="ville" required>
                  <option ></option>
                  @foreach($villes as $ville)
                  <option  value="{{$ville->id}}"{{ old('ville')==$ville->id ? 'selected' : ''  }}> {{$ville->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="adresse" class=" col-form-label">Adresse<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="adresse" placeholder="" name="adresse" value="{{ old('adresse') }}" required>
            </div>
         </div>
         <div class="form-group row">
            <label for="latitude" class=" col-form-label">Latitude<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input  class="form-control" id="latitude" placeholder="exemple: 10.23656" name="latitude" type="number" min="1" step="any" value="{{ old('latitude') }}" >
            </div>
         </div>
         <div class="form-group row">
            <label for="longitude" class=" col-form-label">Longitude<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input  class="form-control" id="longitude" placeholder="exemple: 10.23656" name="longitude" type="number" min="1" step="any" value="{{ old('longitude') }}" >
            </div>
         </div>

         {{-- chanmp exercice de l'ancien base de donnee
         <div class="form-group row">
            <label for="exercice" class=" col-form-label">Exercice<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" id="exercice" name="exercice" required>
                  <option></option>
                  @foreach($exercices as $exercice)
                  <option value="{{$exercice->id}}"> {{$exercice->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         --}}
         <div class="form-group row">
            <label for="mode" class=" col-form-label">Mode Exercice<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" id="mode" name="mode" required>
                  <option></option>
                  @foreach($modes as $mode)
                  <option value="{{$mode->id}}" {{ old("mode")==$mode->id ? 'selected' : ''  }}> {{$mode->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row" id="type-mode-exercice">
            <label for="type_exercice" class=" col-form-label">Type Mode d'exercice</label>
            <div class="col-sm-8">
               <select class="form-control" id="type_exercice" name="type_exercice">
               <option ></option>
               @foreach($salaries as $salarie)
                <option  value="{{$salarie->id}}" {{ old("type_exercice")==$salarie->id ? 'selected' : ''  }}>{{$salarie->libelle}} </option>
               @endforeach

               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="specialite" class="col-form-label">Specialité<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" name="specialite" id="specialite" required>
                  <option></option>
                  @foreach($specialites as $specialite)
                  <option value="{{$specialite->id}}" {{ old("specialite")==$specialite->id ? 'selected' : ''  }}>{{$specialite->libelle}} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="diplome" class=" col-form-label">Diplôme<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <select class="form-control" name="diplome" id="diplome" required>
                  <option></option>
                  @foreach($diplomes as $diplome)
                  <option value="{{$diplome->id}}" {{ old("diplome")==$diplome->id ? 'selected' : ''  }}>{{$diplome->libelle}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="annee-diplome" class=" col-form-label">Date diplôme<span class="obligatoire">*</span></label>
            <div class="col-sm-8">
               <input type="date" class="form-control" id="annee_diplome" name="annee_diplome" value="{{ old('annee_diplome') }}" required>
            </div>
         </div>

         <div class="form-group row" id="epouse_balise">
            <label for="epouse" class=" col-form-label">Epouse</label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="epouse" placeholder="" name="epouse" value="{{ old('epouse') }}">
            </div>
         </div>
         <div class="form-group row justify-content-center">
            <label for="sexe" class=" col-form-label">Genre<span class="obligatoire">*</span></label>
            <div class="custom-control custom-radio custom-control-inline col-sm-4">
               <input type="radio" id="homme" name="sexe" value="1" class="custom-control-input" checked required>
               <label class="custom-control-label" for="homme">Homme</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline col-sm-4">
               <input type="radio" id="femme" name="sexe" value="0" class="custom-control-input">
               <label class="custom-control-label" for="femme">Femme</label>
            </div>
         </div>
      </div>
      <div class="col-md-12 submit-center">
         <button type="submit" class="btn btn-primary
         ">Ajouter</button>
      </div>
   </form>
   {{-- FIN de formulaire --}}
</div>
<script src="{{ asset('js/localiteUpdateMedecin.js') }}"></script>
{{-- <script src="{{ asset('js/localite.js') }}"></script> --}}
@endsection
