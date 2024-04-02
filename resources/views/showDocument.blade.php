@extends('layouts.layout2')
@section('title', 'paramètre')
@section('content')
{{-- section Paramètre --}}
<div class="container">
 <div class="row">
   <div class="title col-md-12">
     <h3>Documents</h3>
   </div>
 </div>
 <div class="row config">
   <div class="col-md-4 doc">
     <a href="{{ route('showLettres',$medecin->id) }}">
       <div class="config-tarifs zoom">
         <img src="{{asset('images/lettre.png')}}" alt="Cromdn">
         <h4>Lettres </h4>
       </div>
     </a>
   </div>   
   <div class="col-md-4 doc">
     <a href="{{ route('showAttestation',$medecin->id) }}">
       <div class="config-admins zoom">
         <img src="{{asset('images/attestation.png')}}" alt="Cromdn">
         <h4>Attestations</h4>
       </div>
     </a>
   </div>        
    <div class="col-md-4 doc">
     <a href="{{ route('showPostale',$medecin->id) }}">
       <div class="config-profil zoom">
         <img src="{{asset('images/info_postales.png')}}" alt="Cromdn">
         <h4>Informations postales</h4>
       </div>
     </a>
   </div>  
 </div>
</div>
@endsection