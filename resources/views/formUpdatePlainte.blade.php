@extends('layouts.layout2')
@section('title', 'Edit plainte')
@section('content')
<div class="container">
  <div class="row">
    <div class="title col-md-12">
      <h3>Editer plainte</h3>
    </div>
  </div>
  {{-- Formulaire UpdatePlainte --}}
  <form class="row" action="{{ route('updatePlainte',$plainte->id) }}" method="post">
    @csrf
    <div class="col-md-12 lot-center1">
      <div class="form-group row justify-content-center">
        <label for="date" class="col-form-label text-center">Date Plainte <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="date" name="date_plainte" class="form-control" value="{{ $plainte->date_plainte}}" required>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="commentaire" class="col-form-label text-center">Commentaire</label>
        <div class="col-sm-4">
          <input type="text" name="commentaire" class="form-control" placeholder="" value="{{ $plainte->commentaire}}">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="decision" class="col-form-label text-center">Décision</label>
        <div class="col-sm-4">
          <input type="text" name="decision" class="form-control" placeholder="" value="{{ $plainte->decision}}">
        </div>
      </div>
      <div class="form-group row justify-content-center">            ​
        <label for="date_decision" class="col-form-label text-center">Date Décision</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="date_decision" name="date_decision" value="{{ $plainte->date_decision}}">
        </div>
      </div>
      ​<div class="form-group row justify-content-center">
        <label for="Motif" class=" col-form-label text-center">Plaignant <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <select class="form-control" id="motif" name="id_motif">
            @foreach($motifs as $motif)
            @if($motif->id===$plainte->id_motif)
            <option  value="{{$motif->id}}" selected>{{$motif->libelle}} </option>
            @else
            <option value="{{$motif->id}}"> {{$motif->libelle}} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class=" row justify-content-center" id="nom-patient">
        <label for="nom-patient" class="col-form-label text-center">Nom Plaignant <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="text" name="nom_plaignant" class="form-control"  value="{{ $plainte->nom_plaignant}}">
        </div>
      </div>
      <div class="form-group row justify-content-center" id="prenom-patient">
        <label for="Prenom-patient" class="col-form-label text-center" value="{{ $plainte->prenom_plaignant}}">Prénom Plaignant <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="text" name="prenom_plaignant" class="form-control"  value="{{ $plainte->prenom_plaignant}}" >
        </div>
      </div>
      <div class="form-group row justify-content-center" id="tel-patient">
        <label for="tel-patient" class="col-form-label text-center">Mobile Plaignant <span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="number" name="tel_plaignant" class="form-control"  value="{{ $plainte->tel_plaignant}}" >
        </div>
      </div>
      <div class="form-group row justify-content-center" id="num-medecin">
        <label for="num-medecin" class="col-form-label text-center">N° Médecin Plaignant<span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <input type="number" max="9999" name="id_medecin_plaignant" class="form-control"  value="{{ $plainte->id_medecin_plaignant}}" >
        </div>
      </div>
      <div class="col-md-4 submit-center-plainte">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
          <a href="{{route('showPlaintes',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
      </div>
    </div>
  </form> 
  {{-- FIN de formulaire --}}
</div>
</div>
​<script src="{{ asset('js/plainte.js') }}"></script>
@endsection