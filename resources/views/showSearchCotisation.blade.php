@extends('layouts.layout1')
@section('title', 'Acceuil')
@section('content')
<div class="container">

   <div class="row">
        <div class="col-md-12 total">
            <h3>
                Recherche Cotisations
            </h3>
        </div>
    </div>

   {{-- Formulaire de recherche --}}
   <form action="{{ route('SearchCotisation') }}" method="POST" class="row">
      @csrf
      <div class="col-md-6 firstlot">

         <div class="form-group row">
            <label for="status" class=" col-form-label">Status</label>
            <div class="col-sm-8" >
               <select name="status" class="form-control" id="status" >
                  <option value="">Tous</option>
                  <option value="0">Impayé</option>
                  <option value="1">Payé</option>
               </select>

            </div>
         </div>

         <div class="form-group row">
            <label for="anne_in" class=" col-form-label">Annee 1</label>
            <div class="col-sm-8">

               <select id="anne_in" name="anne_in" class="form-control ">


                     <?php $now = date('Y'); ?>

                     @for ($i = 1990; $i <= $now; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                     @endfor

               </select>

            </div>
         </div>

         <div class="form-group row">
            <label for="anne_out" class=" col-form-label">Annee 2</label>
            <div class="col-sm-8">

               <select id="anne_out" name="anne_out" class="form-control ">

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
      <div class="col-md-12 block-sexe m-auto">
         <div class="form-group row justify-content-center">
         </div>
      </div>
      <div class="col-md-12 submit-center">
         <button type="submit" id="btn_cotisation" class="btn btn-primary btn-rechercher">Rechercher</button>
      </div>
   </form>
   {{-- fin du formulaire --}}
</div>
<script src="{{ asset('js/localite.js')}}"></script>
@endsection
