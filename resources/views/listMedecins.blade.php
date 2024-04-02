@extends('layouts.layout1')
@section('title', 'Liste des medecins')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 total">
            <h3>
                Liste des Médecins Dentistes <span class="badge badge-light">{{ $medecins->total() }}</span>
            </h3>

        </div>

    </div>

    <!-- Liste  des medecins --->

    <div class="row justify-content-between  entete_medecin">
            <div class="col-md-12"> 
            <div class="float-left btn-list">
            <form action="{{ route('formManyEmail') }}" method="post">
            @csrf
                <input type="hidden" name="medecins" value="{{($medecinsGet->implode('id', ', ') ) }}">
                <button type="submit"  class="btn btn-warning" >
                 Email <i class="fas fa-envelope"></i>
                </button>     
            </form>
        </div>
        <div class="float-left btn-list">
            <form action="{{ route('formManySMS') }}" method="post">
            @csrf
                <input type="hidden" name="medecins" value="{{($medecins->implode('id', ', '))}}">
                <button type="submit"  class="btn btn-info" >
                 SMS <i class="fas fa-sms"></i>
                </button>     
            </form>
        </div>
    </div>
    </div>

    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-12 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N° Inscription</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Profil</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $medecin)
                <tr>
                    <th >{{ $medecin->id }}</th>
                    <td>{{ $medecin->nom }} </td>
                    <td>{{ $medecin->prenom }}</td>
                    <td ><a href="{{ route('showMedecin',$medecin->id) }}">
                        <i class="fas fa-user-circle  fa-2x"></i>
                    </a> 
                    </td>
                    <td><a href="{{ route('showUpdateMedecin',$medecin->id) }}" ><i class="fas fa-edit btn btn-primary" ></i></a>
                    <td>
                        <a  href="{{ route('deleteMedecin',$medecin->id) }}"  onclick="return confirm('voulez-vous vraiment supprimer ce medecin ')">
                            <i class="fas fa-trash-alt btn btn-danger"></i>
                        </a>
                    </td>
                        
                    </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $medecins->links() }}

        </div>
    <a  class="btn btn-danger" style ="color:white;" id="clickmap" data-etap="1">Position <i class="fas fa-map-marker"></i>
    </a>
    <div id="map"></div>
</div>



<script type="text/javascript">
$(document).ready(function(){
$('#map').hide();
$( "#clickmap" ).click(function() {
  var etap =($(this).data('etap'));
  if(etap == 1)
  {
    $('#map').show();
    $('#clickmap').data('etap', 2);
    var locations = <?php print_r(json_encode($locations))?>;
var mymap = new GMaps({
    el: '#map',
    lat: 36.8468607,
    lng: 10.195749,
    zoom:10
});
$.each( locations, function( index, value ){
    mymap.addMarker({
        lat: value.latitude,
        lng: value.longitude,
    });
    });
}
    else
    $('#map').toggle();
});
});
</script>
@endsection