@extends('layouts.layout1')
@section('title', 'Liste des Tarifs')
@section('content')
<div class="container">
  {{--modal Ajout Tarifs--}}
    <div class="modal fade" id="ajouttarif">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title">Ajouter Tarif :</h4>              
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body row">
            <form class="col" action="{{ route('createTarif') }}" method="Post">
              @csrf

              <p>Année : {{ date("Y") }} </p>

              <div class="form-group">
                <label for="montant" class="form-control-label">Tarif</label>
                <input type="text" class="form-control" name ="montant" id="montant" placeholder="tapez ici .." required>
              </div>
              <button type="submit" class="btn btn-primary float-right">Ajouter</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
    {{--modal Ajout Tarifs--}}

    {{--modal Update Tarifs--}}
    <div class="modal fade" id="updatetarif">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edition :</h4>              
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body row">
            <form class="col" action="{{ url('/tarif/update/') }}" method="Post" id='formUpdate' baseURL="{{ url('/tarif/update/') }}">
              @csrf
              <p id='anneeTarifUpdate'>Année : </p>
              <div class="form-group">
                <label for="montant" class="form-control-label">Nouveau tarif</label>
                <input type="text" class="form-control" name ="montant" id="montantUpdate" required>
              </div>

              <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>            
    </div>
    {{--modal Update Tarifs--}}
  <div class="row justify-content-center">
    <div class="col-md-12 total">
      <h3>
        Liste des Tarifs <span class="badge badge-light">{{ $tarifs->total() }}</span>
      </h3>
      <button data-toggle="modal" data-target="#ajouttarif" class="btn btn-primary">Ajouter Tarif
      </button>
    </div>

  </div>
  {{-- liste des tarifs --}}
  <div class="row table-responsive-md justify-content-center">
    <table class="table table-hover table-striped col-md-12 text-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Année</th>
          <th scope="col">Tarifs</th>
          <th scope="col">Edition</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach($tarifs as $tarif)
        <tr>
          <td> {{ $tarif->annee }}   </td>
          <td> {{ $tarif->montant }} </td> 
          <td>
            <a data-toggle="modal" data-target="#updatetarif" data-annee="{{$tarif->annee}}" data-montant="{{$tarif->montant}}" >
              <i class="fas fa-edit btn btn-primary" ></i>
            </a>
          </td>
          {{--
          <td><a href="{{ route('deleteTarif',$tarif->annee) }}" >
            <i class="fas fa-trash-alt btn btn-danger"></i></a> 
          </td> 
          --}}
        </tr>
        @endforeach
      </tbody>
    </table>

    

    {{ $tarifs->render() }}
  </div> 
  <div class="col-md-12 submit-center">
   <a href="{{route('showParametre')}}" class="btn btn-danger btn-rechercher">Retour </a>
  </div> 
</div>
<script src="{{ asset('js/modal.js') }}"></script>
@endsection





