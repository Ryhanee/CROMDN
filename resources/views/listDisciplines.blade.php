@extends('layouts.layout2')
@section('title', 'discipline')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 total">
         <h3>Liste des Disciplines <span class="badge badge-light"> {{ $disciplines->total() }}</span>
         </h3>
         <button data-toggle="modal" data-target="#ajoutDiscipline" class="btn btn-primary">Ajouter Discipline</button>

      </div>
   </div> 
   {{-- modal ajout discipline--}}
   <div class="modal fade" id="ajoutDiscipline">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ajouter discipline </h4>         
               <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
               </button>
            </div>
            <div class="modal-body row">
               <form class="col" action="{{route('createDiscipline')}}" method="Post">
                  @csrf
                  <input type="hidden" name="medecin" value="{{$medecin->id}}">
                  <div class="form-group">
                     <label for="dobservation" class="form-control-label">Référence</label>
                     <input type="text"  class="form-control" rows="5"  name="reference" required>
                  </div>
                  <div class="form-group">
                     <label for="date-convocation" class="form-control-label">Date</label>
                     <input type="date" class="form-control" name ="date" id="date" placeholder="" required>
                  </div>
                  <div class="form-group">
                     <label for="Sanction" class="form-control-label">Sanction</label>
                     <select class="form-control" id="Sanction" name="id_sanction">               

                        @foreach($sanctions as $sanction) 

                        <option value="{{$sanction->id}}"> {{$sanction->libelle}} </option>

                        @endforeach 
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="dobservation" class="form-control-label">Observation</label>
                     <textarea class="form-control" rows="5"  name="observation" id="observation"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
               </form>
            </div>
         </div>
      </div>
   </div>  
   {{-- fin modal ajout discipline--}}     
   {{-- Liste  discipline--}}   
   <div class="row table-responsive-md justify-content-center">
      <table class="table table-hover table-striped col-md-12 text-center">
         <thead class="thead-dark">
            <tr>
               <th scope="col">Référence</th>
               <th scope="col">Date</th>
               <th scope="col">Sanction</th>
               <th scope="col">Recours</th>
               <th scope="col">Observation</th>
               <th scope="col" colspan="2">Actions</th>
            </tr>
         </thead>
         <tbody>

            @foreach($disciplines as $discipline)
            <tr>
               <td>{{ $discipline->reference }}</td>
               <td>{{ date('d-m-Y', strtotime($discipline->date))}}</td> 
               <td>{{ $discipline->sanctions->libelle}}</td>
               <td> {{ transformRecours($discipline->recours) }} </td>
               <td>
                  <a href="#"data-toggle="modal" 
                  data-target="#obser" 
                  data-observation_disciplines="{{ $discipline->observation }}"> 
                  {{substr(htmlspecialchars( $discipline->observation), 0, 12)}}
                  </a>
               </td>
               
               <td>
                  <a data-toggle="modal" 
                  data-target="#editeDiscipline" 
                  data-id_discpline="{{$discipline->id}}" 
                  data-date="{{$discipline->date}}" 
                  data-id_sanction="{{$discipline->id_sanction}}" 
                  data-desc="{{ $discipline->observation }}" 
                  data-reference="{{ $discipline->reference}}"
                  data-recours="{{ $discipline->recours}}">

                  <i class="fas fa-edit btn btn-primary"></i>
               </a>

            </td>
            <td><a href="{{ route('deleteDiscipline',$discipline->id) }}" onclick="return confirm('voulez-vous vraiment supprimer cette plainte ')" ><i class="fas fa-trash-alt btn btn-danger"></i></a> </td>
         </tr>
         @endforeach
      </tbody>
   </table>
   {{ $disciplines->render() }} 
   {{--modal update discipline--}}

   <div class="modal fade" id="editeDiscipline">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Editer Sanction </h4>              
               <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
               </button>
            </div>
            <div class="modal-body row">
               <form action="{{url('/medecin/discipline/update/')}}" method="post"  baseURL="{{url('/medecin/discipline/update/')}}" id="formUpdateDiscpline" class="col">
                  @csrf
                  <input type="hidden" id="medecin" name="medecin" value="{{  $medecin->id  }}">
                  <div class="form-group">
                          <label for="dobservation" class="form-control-label">Référence</label>
                          <input type="text"  class="form-control" rows="5"  name="reference" id="reference" required>
                  </div>
                  <div class="form-group">
                     <label for="date" class="form-control-label">Date</label>
                     <input type="date" class="form-control" name ="date" id="dateUpdate" placeholder="" required>
                  </div>
                  <div class="form-group">
                     <label for="Sanction" class="form-control-label">Sanction</label>

                     <select class="form-control"  name="id_sanction" id="sanctionUpdate">
                        @foreach($sanctions as $sanction)

                        <option value="{{$sanction->id}}" > {{$sanction->libelle}} </option>

                        @endforeach
                     </select>

                  </div>
                  <div class="form-group">
                     <label for="observation" class="form-control-label">Observation</label>
                     <textarea rows="4" cols="50" class="md-textarea form-control" name ="observation" id="descUpdate" placeholder="Ecrire ici .."></textarea>
                  </div>
                  <div class="form-group">
                     <label for="observation" class="form-control-label">Recours</label>
                     <div class="custom-control custom-radio custom-control-inline col-sm-4">
                        <input type="radio" id="oui" name="recours" value="1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="oui">Oui</label>
                     </div>
                     <div class="custom-control custom-radio custom-control-inline col-sm-4">
                        <input type="radio" id="non" name="recours" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="non">Non</label>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
               </form>
            </div>
         </div>
      </div>
   </div> 
   {{-- fin modal update discipline--}}

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
                               <p class="form-control-label" id="observation_disciplines"></p>
                           </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- fin Modal --}}
</div>
<script src="{{ asset('js/modal.js') }}"></script>
</div>

@endsection


