
@extends('layouts.layout2')
@section('title', 'Plainte')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 total">
      <h3>
        Liste des Plaintes <span class="badge badge-light">{{ $plaintes->total() }}</span>
      </h3>     
        <a href="{{ route('showCreatePlainte',$medecin->id) }}"><button type="button" class="btn btn-primary">Ajouter plainte</button></a>      
    </div>
  </div>
  {{-- Liste  des plaintes --}}
    <div class="row table-responsive-md justify-content-center">
      <table class="table table-hover table-striped col-md-12 text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Date plainte</th>
            <th scope="col">Plaignant</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Décision</th> 
            <th scope="col">Date de Décision</th>                  
            <th scope="col">Convocations</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach($plaintes as $plainte)
            <tr>              
              <td>{{date('d-m-Y', strtotime($plainte->date_plainte)) }}</td>
              <td> {{ $plainte->motif->libelle }} </td> 
              <td><a href="#" data-toggle="modal"
                   data-target="#comm" 
                   data-commentaire="{{ $plainte->commentaire }}"> 
                   {{substr(htmlspecialchars( $plainte->commentaire), 0, 12)}}
                </a>
              </td>
              <td><a href="#" data-toggle="modal"
                   data-target="#comm" 
                   data-commentaire="{{ $plainte->decision  }}"> 
                   {{substr(htmlspecialchars( $plainte->decision ), 0, 12)}}
                </a></td>
              @if($plainte->date_decision)
              <td>{{date('d-m-Y', strtotime($plainte->date_decision)) }}</td>
              @else
              <td>{{ $plainte->date_decision }}</td>
              @endif
              <td><a href="{{ route('showConvocations',$plainte->id) }}"><i class="fa fa-scroll btn btn-info"></i></a> </td>
              <td><a href="{{ route('showUpdatePlainte',$plainte->id) }}" ><i class="fas fa-edit btn btn-primary" ></i></a> </td>
              <td><a href="{{ route('deletePlainte',$plainte->id) }}" onclick="return confirm('voulez-vous vraiment supprimer cette plainte ')" ><i class="fas fa-trash-alt btn btn-danger"></i></a> </td>
            </tr>
            @endforeach 
        </tbody>
      </table>
      {{ $plaintes->render() }} 
    </div>

    {{-- Commentaire Modal --}}
           <div class="modal fade" id="comm">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Commentaire</h4>
                       <button type="button" class="close" data-dismiss="modal">
                           <span>&times;</span>
                       </button>
                   </div>
                   <div class="modal-body row">
                           <div class="form-group">
                               <p class="form-control-label" id="commentaire_plainte"></p>
                           </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- fin Modal --}}
       <script src="{{ asset('js/modal.js') }}"></script>
  </div>  ​
  @endsection




