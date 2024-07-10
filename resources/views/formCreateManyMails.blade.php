@extends('layouts.layout1')
@section('title', 'Envoi mail ')
@section('content')
<div class="container">
    <div class="row">
        <div class="title col-md-12">
            <h3>Envoi mail</h3>
        </div>
    </div>
    {{-- Formulaire d'envoi mail --}}

    <form class="row" action="{{ route('sendManyEmail') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="medecins" value="{{ $medecinsId }}">
        <div class="col-md-12 lot-center-mail">
            <div class="form-group row justify-content-center">
                <label for="objet" class="form-label">Objet</label>
                <div class="col-sm-4">
                    <input type="objet" name="subject" class="form-control" id="objet" placeholder="">
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label for="Contenue" class="form-label">Message<span class="obligatoire">*</span></label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="10"  name="mail" id="Contenue" required></textarea>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label for="files" class="form-label">Pièce jointe</label>
                <div class="col-sm-4">
                    <input class="form-control" name="files[]" type="file" id="files" multiple>
                </div>
            </div>
            <div class="submit-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
                {{--<input type="button" value="Retour" onclick="history.go(-1)" class="btn btn-danger btn-rechercher">--}}
                <a href="{{ route('listMedecins',$medecinsId)}}" class="btn btn-danger btn-rechercher">Retour </a>
            </div>
        </div>
    </form>
    {{-- fin Formulaire d'envoi mail --}}
</div>
@endsection
