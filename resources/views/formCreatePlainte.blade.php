@extends('layouts.layout2')
@section('title', 'Création des plaintes')
@section('content')
<div class="container">
    <div class="row">
        <div class="title col-md-12">
            <h3>Ajouter plainte</h3>
        </div>
    </div>
    {{-- Formulaire Create Plainte  --}}    ​
    <form class="row" action="{{ route('createPlainte',$medecin->id) }}" method="post">
        @csrf
        <div class="col-md-12 lot-center1">    ​
            <div class="form-group row justify-content-center">            ​
                <label for="date_plainte" class="col-form-label text-center">Date Plainte <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="date_plainte" name="date_plainte" required>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label for="id_motif" class=" col-form-label text-center">Plaignant <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control" id="motif" name="id_motif">
                        @foreach($motifs as $motif)
                            <option value="{{$motif->id}}"> {{$motif->libelle}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row justify-content-center" id="nom-patient">
                <label for="nom_plaignant" class="col-form-label text-center">Nom Plaignant <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="nom_plaignant" id="nom_plaignant"  class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group row justify-content-center" id="prenom-patient">
                <label for="prenom_plaignant" class="col-form-label text-center">Prénom Plaignant <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="prenom_plaignant" id="prenom_plaignant" class="form-control" placeholder="" >
                </div>
            </div>
            <div class="form-group row justify-content-center" id="tel-patient">
                <label for="tel_plaignant" class="col-form-label text-center">Mobile Plaignant <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="tel_plaignant" id="tel_plaignant" class="form-control" placeholder="">
                </div>
            </div>

            <div class="form-group row justify-content-center" id="num-medecin">
                <label for="id_medecin_plaignant" class="col-form-label text-center">N° Médecin Plaignant <span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <input type="number" name="id_medecin_plaignant" id="id_medecin_plaignant" class="form-control" placeholder="">
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <label for="commentaire" class="col-form-label text-center">Commentaire</label>
                <div class="col-sm-4">
                    <input type="text" name="commentaire" id="commentaire" class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label for="decision" class="col-form-label text-center">Décision</label>
                <div class="col-sm-4">
                    <input type="text" name="decision" id="decision" class="form-control" placeholder="">
                </div>
            </div>  
            <div class="form-group row justify-content-center">            ​
                <label for="date_decision" class="col-form-label text-center">Date Décision</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="date_decision" name="date_decision">
                </div>
            </div>          ​
            <div class="col-md-4 submit-center-plainte">                ​
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="{{route('showPlaintes',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
            </div>
        </div>
    </form>
    {{-- FIN de formulaire   --}}
</div>
</div>
<script src="{{ asset('js/plainte.js') }}"></script>
@endsection
