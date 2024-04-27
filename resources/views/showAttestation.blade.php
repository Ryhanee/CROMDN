@extends('layouts.layout2')
@section('title', 'Attestation medecin')
@section('content')

<div class="container">
	<div class="row">
	   	<div class="title col-md-12">
	       <h3>Attestations </h3>
	 	</div>
	</div>

 	<form class="row" action="{{ route('generatePDFasttestation') }}" method="post" target="_blank">
        @csrf
        <input type="hidden" name="idMedecin" value="{{$medecin->id}}">
        <input type="hidden" name="document_type" id="document_type" value="word">
        <div class="col-md-12 lot-center1">

    		<div class="form-group row justify-content-center">

                <div class="col-md-4">
                <select class="form-control" id="attestation" name="attestation">
                        @foreach($attestations as $attestation)
                            <option value="{{$attestation->id}}">{{$attestation->libelle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row justify-content-center ">
                <div class="col-md-4">
      <input type="text" name="ref" class="form-control" id="ref" placeholder="Référence">
                </div>
            </div>

            <div  class="form-group row justify-content-center ">
                <div class="col-md-4">
      <input type="text" name="pres" class="form-control" id="pres" placeholder="Président">
                </div>
            </div>

            <div class="submit-center-lettre">
                <button type="submit" name="download_pdf" class="btn btn-info preview" >Télécharger PDF</button>
                <button type="submit" name="download_word" class="btn btn-primary" >Télécharger Word</button>
                <input type="button" value="Retour" onclick="history.go(-1)" class="btn btn-danger btn-rechercher">
            </div>
        </div>
    </form>
</div>

<script src="{{ asset('js/attestation.js') }}"></script>
@endsection
