@extends('layouts.layout2')
@section('title', 'Editer medecin')
@section('content')
<div class="container">
  <div class="row">
     <div class="title col-md-12">
        <h3>Editer médecin Dentiste</h3>
     </div>
  </div>
  {{-- Formulaire d'update  medecin --}}
  <form class="row" action="{{ route('updateMedecin',$medecin->id) }}" method="POST">
    @csrf
    <div class="col-md-6 firstlot">
      <div class="form-group row">
        <label for="num_inscerit" class=" col-form-label">Numéro d'inscription<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="number"  class="form-control" id="num_inscerit"  name="num_inscerit" placeholder="Numéro d'inscription" value="{{$medecin->id}}" min="1" required>
          @error('id')
               <p style="color:brown;"><i class="fas fa-exclamation-circle"></i> {{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="date_naissance" class=" col-form-label">Date de naissance<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="date" class="form-control" id="date_naissance" placeholder="" name="date_naissance" value="{{$medecin->date_naissance}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="nom" class=" col-form-label">Nom<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="text"  class="form-control" id="nom" name="nom" value="{{$medecin->nom}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="prenom" class=" col-form-label">Prénom<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="prenom" placeholder="" name="prenom"  value="{{$medecin->prenom}}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="lieu_naissance" class=" col-form-label">lieu de naissance</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="lieu_naissance" placeholder="" name="lieu_naissance" value="{{$medecin->lieu_naissance}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class=" col-form-label">Email<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="email"  class="form-control" id="email"  name="email"value="{{$medecin->email}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="date-inscription" class=" col-form-label">Date d'inscription<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="date" class="form-control" id="date_inscrit" name="date_inscrit" value="{{ $date_insecrit }}" required>
          @error('date')
          <p style="color:brown;"><i class="fas fa-exclamation-circle"></i> {{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="gsm" class=" col-form-label">Mobile<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="gsm" placeholder="Numéro de téléphone (8 chiffres)" pattern="[0-9]{8}" name="gsm" value="{{$medecin->gsm}}"  required >
        </div>
      </div>
      <div class="form-group row">
        <label for="fixe" class=" col-form-label">Autres numéros</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="fixe"  name="fixe" value="{{$medecin->fixe}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="site_web" class=" col-form-label">Site web</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="site_web" placeholder="" name="site_web" value="{{$medecin->site_web }}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="nationalite" class=" col-form-label">Nationalité<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" id="nationalite" name="nationalite" required>
            @foreach($nationalites as $nationalite)
            @if($nationalite->id===$medecin->id_nationalite)
            	<option  value="{{$nationalite->id}}" selected>{{$nationalite->libelle}} </option>
            @else
			  	<option  value="{{$nationalite->id}}">{{$nationalite->libelle}} </option>
			@endif
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
            @foreach($gouvernorats as $Gouvernorat)
            @if($Gouvernorat->id===$medecin->id_gouvernorat)
            <option  value="{{$Gouvernorat->id}}" selected>{{$Gouvernorat->libelle}} </option>
            @else
            <option value="{{$Gouvernorat->id}}"> {{$Gouvernorat->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="delegation" class=" col-form-label">Délégation<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" id="delegation" name="delegation" required>
            @foreach($delegations as $delegation)
              @if($delegation->id===$medecin->id_delegation)
              <option  value="{{$delegation->id}}" selected>{{$delegation->libelle}} </option>
              @else
              <option  value="{{$delegation->id}}" >{{$delegation->libelle}} </option>
              @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="ville" class="col-form-label">Localité<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" name="ville" id="ville" required>
            @foreach($villes as $ville)
              @if($ville->id==$medecin->id_ville)
              <option  value="{{$ville->id}}" selected>{{$ville->libelle}} </option>
              @else
              <option  value="{{$ville->id}}" >{{$ville->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="adresse" class=" col-form-label">Adresse<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="adresse" placeholder="" name="adresse" value="{{$medecin->adresse}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="latitude" class=" col-form-label">Latitude<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input  class="form-control" id="latitude" placeholder="exemple: 10.23656" name="latitude" type="number" min="1" step="any" value="{{$latitude}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="longitude" class=" col-form-label">Longitude<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input  class="form-control" id="longitude" placeholder="exemple: 10.23656" name="longitude" type="number" min="1" step="any" value="{{$longitude}}" >
        </div>
      </div>
      {{-- chanmp exercice de l'ancien base de donnee
      <div class="form-group row">
        <label for="exercice" class=" col-form-label">Exercice<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" id="exercice" name="exercice" required>
            @foreach($exercices as $exercice)
            @if($exercice->id===$medecin->id_exercice)
            <option  value="{{$exercice->id}}" selected>{{$exercice->libelle}} </option>
            @else
            <option value="{{$exercice->id}}"> {{$exercice->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      --}}
      <div class="form-group row">
        <label for="mode" class=" col-form-label">Mode<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" id="mode" name="mode" required>
            @foreach($modes as $mode)

              @if($mode->id == $medecin->id_mode)
              <option  value="{{$mode->id}}" selected> {{$mode->libelle}}
              </option>
              @else
              <option value="{{$mode->id}}"> {{$mode->libelle}} </option>
              @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row" id="type-mode-exercice">
        <label for="type_exercice" class=" col-form-label">Type Mode d'exercice</label>
        <div class="col-sm-8">
          <select class="form-control" id="type_exercice" name="type_exercice" >
            @if(isset($medecin->type_exercice->id))
              @foreach($salaries as $salarie)

                @if($salarie->id==$medecin->type_exercice->id)
                  <option  value="{{$salarie->id}}" selected>{{$salarie->libelle}} </option>
                @else
                <option  value="{{$salarie->id}}">{{$salarie->libelle}}
                </option>
                @endif
              @endforeach
            @else
            <option value="">Indéfini</option>
            @endif
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="specialite" class="col-form-label">Specialité<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" name="specialite" id="specialite" required>
            @foreach($specialites as $specialite)
            @if($specialite->id===$medecin->id_specialite)
            <option  value="{{$specialite->id}}" selected>{{$specialite->libelle}} </option>
            @else
            <option value="{{$specialite->id}}"> {{$specialite->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="diplome" class=" col-form-label">Diplôme<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <select class="form-control" name="diplome" id="diplome" required>
            @foreach($diplomes as $diplome)
            @if($diplome->id===$medecin->id_diplome)
            <option  value="{{$diplome->id}}" selected>{{$diplome->libelle}} </option>
            @else
            <option value="{{$diplome->id}}"> {{$diplome->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="annee-diplome" class=" col-form-label">Année diplôme<span class="obligatoire">*</span></label>
        <div class="col-sm-8">
          <input type="date" class="form-control" id="annee_diplome" name="annee_diplome"  value="{{$medecin->annee_diplome }}" required>
        </div>
      </div>

      <div class="form-group row" id="epouse_balise">
        <label for="epouse" class=" col-form-label">Epouse</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="epouse" placeholder="" name="epouse" value="{{$medecin->epouse }}" >
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="sexe" class=" col-form-label">Genre</label>
        @if($medecin->sexe == 1)
        <div class="custom-control custom-radio custom-control-inline col-sm-4">
          <input type="radio" id="homme" name="sexe" value="1" class="custom-control-input" checked required>
          <label class="custom-control-label" for="homme">Homme</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline col-sm-4">
          <input type="radio" id="femme" name="sexe" value="0" class="custom-control-input" >
          <label class="custom-control-label" for="femme" >Femme</label>
        </div>
        @else
        <div class="custom-control custom-radio custom-control-inline col-sm-4">
          <input type="radio" id="homme" name="sexe" value="1" class="custom-control-input" >
          <label class="custom-control-label" for="homme">Homme</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline col-sm-4">
          <input type="radio" id="femme" name="sexe" value="0" class="custom-control-input" checked required>
          <label class="custom-control-label" for="femme" >Femme</label>
        </div>
        @endif
      </div>
    </div>
    <div class="col-md-12 submit-center">
      <button type="submit" class="btn btn-primary">Enregistrer</button>
       <a href="{{route('showMedecin',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
    </div>
  </form>
  <script src="{{ asset('js/localiteUpdateMedecin.js') }}"></script>
  {{-- Fin Formulaire d'update  medecin --}}
  @endsection
