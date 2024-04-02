@extends('layouts.layout1')
@section('title', 'paramètre')
@section('content')
{{-- section Paramètre --}}
<div class="container">
 <div class="row">
   <div class="title col-12">
     <h3>Paramètres</h3>
   </div>
 </div>
 <div class="row config">
   <div class="col-md-3 param" id="param1">
     <a href="{{ route('showTarifs') }}">
       <div class="config-tarifs zoom">
         <img src="{{asset('images/cotisation.png')}}" alt="Cromdn">
         <h4>Tarifs</h4>
       </div>
     </a>
   </div>
   @if(Auth::user()->id_role ==1)
   <div class="col-md-3 param">
     <a href="{{ route('showUsers') }}">
       <div class="config-admins zoom">
         <img src="{{asset('images/admins.png')}}" alt="Cromdn">
         <h4>Administrateurs</h4>
       </div>
     </a>
   </div>
    @endif
    <div class="col-md-3 param">
     <a href="{{ route('showUser',Auth::user()->id) }}">
       <div class="config-profil zoom">
         <img src="{{asset('images/profil.png')}}" alt="Cromdn">
         <h4>Profil</h4>
       </div>
     </a>
   </div>
   
 </div>
</div>
@endsection