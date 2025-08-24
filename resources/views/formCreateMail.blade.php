@extends('layouts.layout2')
@section('title', 'Envoi mail ')
@section('content')
<div class="container">
  <div class="row">
    <div class="title col-md-12">
      <h3>Envoi Email</h3>
    </div>
  </div>
  {{-- Formulaire d'envoi mail --}}
  <form class="row" action="{{ route('sendEMail') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 lot-center-mail">
      <input type="hidden" name="idMedecin" value="{{$medecin->id}}">
      <div class="form-group row justify-content-center">
        <label for="objet" class="col-form-label text-center">Objet</label>
        <div class="col-sm-4">
          <input type="objet" name="subject" class="form-control" id="objet" placeholder="">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="Contenue" class="col-form-label text-center">Message<span class="obligatoire">*</span></label>
        <div class="col-sm-4">
          <textarea class="form-control" rows="10"  name="mail" id="Contenue" required></textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="files" class="col-form-label text-center">Pi�ce jointe</label>
        <div class="col-sm-4">
          <input class="form-control" name="files[]" type="file"  multiple>
        </div>
      </div>
      <div class="col-md-4 submit-center-email">
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="{{route('showMedecin',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
      </div>
    </div>
  </form>
  {{-- fin Formulaire d'envoi mail --}}
</div>
@endsection
