@extends('layouts.layout2')
@section('title', 'Convocation')
@section('content')
​
<div class="container">
    <div class="row">        
        <div class="col-md-12 total">
            <h3>
                Liste des Convocations <span class="badge badge-light">{{ $convocations->total() }}</span>
            </h3>
            <button data-toggle="modal" data-target="#ajoutconvocation" class="btn btn-primary">Ajouter Convocation</button>
        </div>
        <div class="col-md-12 text-left">
            <p class="info-plainte">Numéro de la plainte : <span class="numero-plainte">{{  $plainte->id }}</span></p>
            <p class="info-plainte">Date de la plainte : <span class="numero-plainte">{{  $plainte->date_plainte }}</span></p>

        </div>
        {{--modal ajout convocation--}}

        <div class="modal fade" id="ajoutconvocation">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter convocation </h4>              
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <form class="col" action="{{ route('createConvocation') }}" method="Post">
                            @csrf
                            <input type="hidden" id="idPlainte" name="idPlainte" value="{{  $plainte->id  }}">
                            <div class="form-group">
                                <label for="date-convocation" class="form-control-label">Date de la Convocation </label>
                                <input type="date" class="form-control" name="date" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label for="observation" class=" form-control-label">Observation</label>
                                    <textarea class="form-control" name="observation" 
                                    rows="5"></textarea>       
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Enregister</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>        
    </div>

    {{-- fin modal ajout convocation--}}

    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-12 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Observation</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" name="medecin" value="{{$medecin}}">
                @foreach($convocations as $convocation)
                <tr>

                    <td> {{ date('d-m-Y', strtotime($convocation->date)) }} </td> 
                    <td> 
                        <a href="#" data-toggle="modal" 
                        data-target="#obser" 
                        data-observation_convocations="{{ $convocation->observation}}"> {{substr(htmlspecialchars( $convocation->observation), 0, 12)}}
                        </a>
                    </td>
                    <td>             
                        <a 
                            data-toggle="modal" 
                            data-target="#updateconvocation"
                            data-conv="{{ $convocation->id }}" 
                            data-date="{{$convocation->date}}"
                            data-obser="{{ $convocation->observation }}">
                            <i class="fas fa-edit btn btn-primary" ></i>
                        </a>
                    </td>

                    <td><a href="{{ route('deleteConvocation',$convocation->id)}}" onclick="return confirm('voulez-vous vraiment supprimer cette plainte ')" >
                      <i class="fas fa-trash-alt btn btn-danger"></i></a> </td>
                </tr>
                @endforeach


            </tbody>
        </table>

        {{ $convocations ->render() }}

        {{-- modal update convocation --}}

        <div class="modal fade" id="updateconvocation">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editer convocation </h4>              
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <form id="formUpdate" class="col" action="{{ url('/medecin/plainte/convocation/update/') }}" method="Post"
                        baseURL="{{url('/medecin/plainte/convocation/update/') }}">
                            @csrf
                            <div class="form-group">
                                <label for="date" class="form-control-label">Date</label>
                                <input type="date" class="form-control" name ="date" id="date" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label for="observation" class="form-control-label">Observation</label>
                                <textarea rows="4" cols="50" class="md-textarea form-control" name ="observation" id="observation" placeholder="Ecrire ici .."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Enregister</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  

        {{--  fin modal update convocation--}}
    </div>
        <div class="col-md-12 submit-center">
        <a href="{{route('showPlaintes',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
      </div>

      {{-- Observation Modal --}}
           <div class="modal fade" id="obser">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Observation</h4>
                       <button type="button" class="close" data-dismiss="modal">
                           <span>&times;</span>
                       </button>
                   </div>
                   <div class="modal-body row">
                           <div class="form-group">
                               <p class="form-control-label" id="observation_convocations"></p>
                           </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- fin Modal --}}




{{-- Observation Modal --}}
           <div class="modal fade" id="obser">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Observation</h4>
                       <button type="button" class="close" data-dismiss="modal">
                           <span>&times;</span>
                       </button>
                   </div>
                   <div class="modal-body row">
                           <div class="form-group commentaire">
                               <p class="form-control-label" id="observation_convocations"></p>
                           </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- fin Modal --}}
</div>

​ <script src="{{ asset('js/modal.js') }}"></script>
@endsection