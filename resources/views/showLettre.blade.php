@extends('layouts.layout2')
@section('title', 'Profile medecin')
@section('content')

<div class="container">
	<div class="row">
	   	<div class="title col-md-12">
	       <h3>Letrres </h3>
	 	</div>
	</div>

 	<form class="row" action="{{ route('generatePDFlettre') }}" method="post" target="_blank">
        @csrf
        <input type="hidden" name="idMedecin" value="{{$medecin->id}}">

        <div class="col-md-12 lot-center1">    ​

    		<div  class="form-group row justify-content-center">                
                <div class="col-md-4">
                    <select class="form-control" id="lettre" name="lettre">
                        @foreach($lettres as $lettre) 

                        	<option value="{{$lettre->id}}"> 
                        		{{$lettre->libelle}}   
                        	</option>       

                        @endforeach
                    </select>
                </div>

            <div class="submit-center-lettre col-md-12"> 
                           ​
                <button type="submit" name="print" class="btn btn-primary" >Print PDF</button>
                <button type="submit" name="preview" class="btn btn-info preview" >Visualiser PDF</button>

                <input type="button" value="Retour" onclick="history.go(-1)" class="btn btn-danger btn-rechercher">
        
            </div>
        </div>
    </form> 

 </div>

@endsection