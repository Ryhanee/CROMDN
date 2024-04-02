@extends('layouts.layout2')
@section('title', 'liste des etats')
@section('content')
<div class="container"> 
  <div class="row">
    <div class="col-md-12 total">            
      <h3>
        Liste des Etats  <span class="badge badge-light">{{ $etats->total() }}</span>
      </h3>
      <button data-toggle="modal" data-target="#ajoutetat" class="btn btn-primary">
        Ajouter Etat
      </button>               
    </div>
    <div class="col-md-6">
      <p class="info-etat">Mode d'exercice actuel : <span class="etat-actuel">{{$medecin->mode->libelle}}</span></p>
    </div>
  </div>             
  {{-- Modal create etat --}} 
  <div class="modal fade" id="ajoutetat">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ajouter état </h4>         
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <form class="col" action="{{route('createEtat')}}" method="Post">
            @csrf
            <input type="hidden" name="medecin" value="{{$medecin->id}}">
            <div class="form-group">
              <label for="type" class="form-control-label">Type</label>
              <select class="form-control" name="typeEtat" required>
                <option></option>
                @foreach($modes as $typeEtat)
                <option  value="{{$typeEtat->id}}" > 
                  {{$typeEtat->libelle}} 
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="date" class="form-control-label">Date</label>
              <input type="date" class="form-control" name ="date" id="Date" placeholder="tapez ici .." >
            </div>
            
            <div class="form-group">
              <label for="description" class="form-control-label">Description</label>
              <input type="text" class="form-control" name ="description" id="description" placeholder="tapez ici ..">
            </div>

            <div class="form-group">
            <label for="gouvernorat" class=" col-form-label">Gouvernorat
            </label>
               <select class="form-control" id="gouvernorat" name="gouvernorat" required>
                  <option></option>
                  @foreach($gouvernorats as $gouvernorat)
                  <option value="{{$gouvernorat->id}}"> {{$gouvernorat->libelle}} </option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
            <label for="adresse" class=" col-form-label">Délégation</label>
              <select class="form-control" name="delegation" id="delegation" required>
                  <option></option>
               </select>            
            </div>

            <div class="form-group">
            <label for="ville" class="col-form-label">Localité</label>
              <select class="form-control" name="ville" id="ville" required>
                  <option></option>
               </select>            
            </div>
        
            <div class="form-group">
              <label for="adresse" class="form-control-label">Adresse</label>
              <input type="text" class="form-control" name ="adresse" id="adresse" placeholder="tapez ici .." required>
            </div>

            <button type="submit" class="btn btn-primary float-right">Ajouter</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  {{-- FIN Modal create etat --}}
  {{-- liste des etats  --}}
  <div class="row table-responsive-md justify-content-center">
    <table class="table table-hover table-striped col-md-12 text-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Mode Exercice</th>
          <th scope="col">Type</th>
          <th scope="col">Adresse</th>
          <th scope="col">Description</th>
          <th scope="col" colspan="2">Actions</th>

        </tr>
      </thead>
      <tbody>
        <input type="hidden" name="medecin" value="{{$medecin->id}}">
        @foreach($etats as $etat)
        <tr>
          <td> {{ date('d-m-Y', strtotime($etat->date))}}   </td>
          <td> {{ $etat->mode->libelle}} </td>
          <td> {{ $etat->typeEtat->libelle}} </td>
          <td> 
            @if($etat->id_gouvernorat  !== null )
            {{$etat->gouvernorat->libelle}}, 
            @else
            {{ $etat->id_gouvernorat}} 
            @endif

            @if($etat->id_delegation !== null)
            {{$etat->delegation->libelle}}, 
            @else
            {{ $etat->id_delegation}} 
            @endif

            @if($etat->id_ville !== null)
            {{$etat->ville->libelle}}, 
            @else
            {{ $etat->id_ville}}  
            @endif

            {{ $etat->address }} 
          </td>
          <td ><a href="#" data-toggle="modal" 
              data-target="#descriptionEtat" 
              data-description_etat="{{ $etat->desc}}"> 
              {{substr(htmlspecialchars( $etat->desc), 0, 12)}}
              </a>
          </td>
          <td>
            <a id="buttonUpdate" data-toggle="modal"
            data-target="#editeEtat"
            data-id_etat="{{$etat->id}}"
            data-date="{{$etat->date}}"
            data-id_type="{{$etat->id_type}}"
            data-desc="{{ $etat->desc }}" 
            data-gouvernorat="{{ $etat->id_gouvernorat}}"
            data-delegation="{{ $etat->id_delegation}}"
            data-ville="{{ $etat->id_ville}}"
            data-addresse="{{ $etat->address }}"
            data-id_mode="{{ $etat->mode->id}}">
            <i class="fas fa-edit btn btn-primary" ></i>
          </a>
        </td>
        <td>

          @if($etat->id_type !=10)
          <a href="{{route('deleteEtat', [$etat->id,$medecin->id] )}}" onclick="return confirm('voulez-vous vraiment supprimer cet état ')"  >
            <i class="fas fa-trash-alt btn btn-danger"></i>
          </a> 
          @endif

        </td>
      </tr>
      @endforeach            
    </tbody>
  </table>
  {{-- Modal update etat --}}

  <div class="modal fade" id="editeEtat">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editer état</h4>             
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <form id="formUpdateEtat" class="col" action="{{url('/medecin/etat/update/')}}" method="Post" baseURL="{{url('/medecin/etat/update/')}}">
            @csrf
            
            <div class="form-group">
              <input type="hidden" name="medecin" value="{{$medecin->id}}">
              <label for="typeEtatUpdate" class="form-control-label">Type</label>
              <select class="form-control" id="typeEtatUpdate" name="typeEtat" required>

              </select>
            </div>
            
            <div class="form-group">
              <label for="date" class="form-control-label">Date</label>
              <input type="date" class="form-control" name ="date" id="dateUpdate" placeholder="tapez ici .."required>
            </div>
            <div class="form-group">
              <label for="description" class="form-control-label">Description</label>
              <input type="text" class="form-control" name ="desc" id="descUpdate" placeholder="tapez ici ..">
            </div>

            <div class="form-group">
            <label for="gouvernorat" class=" col-form-label">Gouvernorat
            </label>
               <select class="form-control" id="gouvernoratEtat" name="gouvernorat">
                  <option></option>
                  @foreach($gouvernorats as $gouvernorat)
                  <option value="{{$gouvernorat->id}}"> {{$gouvernorat->libelle}} </option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
            <label for="adresse" class=" col-form-label">Délégation</label>
              <select class="form-control" name="delegation" id="delegationEtat">
                {{--<option></option>
                @foreach($delegations as $delegation)  
                  <option  value="{{$delegation->id}}">{{$delegation->libelle}} </option>    
                @endforeach --}}
               </select>            
            </div>

            <div class="form-group">
            <label for="ville" class="col-form-label">Localité</label>
              <select class="form-control" name="ville" id="villeEtat">
                {{--<option></option>
                @foreach($villes as $ville)
                  <option  value="{{$ville->id}}">{{$ville->libelle}} </option>
                @endforeach --}}
               </select>            
            </div>
        
            <div class="form-group">
              <label for="adresse" class="form-control-label">Adresse</label>
              <input type="text" class="form-control" name ="adresse" id="adresseEtat" placeholder="tapez ici .." required>
            </div>

            <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN Modal update etat --}}

  {{ $etats->render() }} 
</div>
{{-- Description Modal --}}
           <div class="modal fade" id="descriptionEtat">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Description</h4>
                       <button type="button" class="close" data-dismiss="modal">
                           <span>&times;</span>
                       </button>
                   </div>
                   <div class="modal-body row">
                           <div class="form-group commentaire">
                               <p class="form-control-label" id="description_etat"></p>
                           </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- fin Modal --}}
       

</div>
<script src="{{ asset('js/localite.js') }}"></script>
<script src="{{ asset('js/localiteEtat.js') }}"></script>
​<script src="{{ asset('js/modal.js') }}"></script>

@endsection