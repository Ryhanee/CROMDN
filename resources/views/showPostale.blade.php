@extends('layouts.layout2')
@section('title', 'Profile medecin')
@section('content')

<div class="container">
	<div class="row">
	   	<div class="title col-md-12">
	     <h3>Données Postales</h3>
	   	{{--<a href="{{ route('generatePDFpostale',$medecin->id) }}" target="_blank"><button  class="btn btn-primary">Print PDF</button></a>--}}
	 	</div>
	</div>

 	<div  >   		
   		<div id="postale" class="title col-md-5">
   			
     			<h5 id="pseudo">{{$medecin->prenom}} {{ $medecin->nom}}</h5>
     			<h6 id="adress">{{$medecin->adresse}}</h6>	
     			<h5 id="code">{{$medecin->ville->code_postal}}</h5>	
   		</div>
      <div class="submit-center-lettre">                ​
<a href="{{ route('generatePDFpostale',$medecin->id) }}" target="_blank"><button  class="btn btn-primary">Print PDF</button></a>
        <input type="button" value="Retour" onclick="history.go(-1)" class="btn btn-danger btn-rechercher">

      </div>
   	</div>
 </div>

@endsection