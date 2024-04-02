@extends('layouts.layout2')
@section('title', 'Profile medecin')
@section('content')

<div class="container">
  <div class="row">
            <div class="title col-md-12">
              <h3>Profil Médecin Dentiste</h3> 
            </div>        
        </div>
            <div class="row justify-content-between  entete_medecin">
               <div class="col-md-12  ">
                   <a class="btn btn-dark float-right"  href="{{route('deleteMedecin',$medecin->id) }}" onclick="return confirm('voulez-vous vraiment supprimer ce medecin')">
                       Supprimer <i class="fas fa-trash-alt"></i>
                   </a>
                   <a  class="btn btn-dark float-right" href="{{route('showUpdateMedecin',$medecin->id) }}">
                       Editer <i class="fas fa-edit"></i>
                   </a>
                   <a  class="btn btn-warning" href="{{route('formMail',$medecin->id) }}">
                       Email <i class="fas fa-envelope-open-text"></i>
                   </a>
                   <a class="btn btn-info"  href="{{route('showFormSMS',$medecin->id) }}" >
                       SMS <i class="fas fa-sms"></i>
                   </a>
                   <a class="btn btn-info btn-document"  href="{{route('showDocument',$medecin->id) }}">
                      Documents <i class="fas fa-folder-open"></i>
                  </a>
               </div>
           </div>
                <div class="row affiche-profile">
                <div class="col-md-4 first-lot1">
                    <p class="Nom">Nom : <span class="resultat">{{$medecin->nom }}</span></p>
                    <p class="prenom">Prénom : <span class="resultat">{{$medecin->prenom }}</span></p>
                    <p class="Nom">Email : <span class="resultat">{{$medecin->email }}</span></p>
                    <p class="Nom">Date de naissance : <span class="resultat">{{date('d-m-Y', strtotime($medecin->date_naissance)) }}</span></p>             <p class="Nom">Nationalité : <span class="resultat">{{$medecin->nationalite->libelle }}</span></p>    
                    <p class="Nom">Genre : <span class="resultat">
                        {{transformGenre($medecin->sexe) }}</span></p>
                    <p class="Nom">Epouse : <span class="resultat">{{$medecin->epouse }}</span></p>
                                              
                </div>

                <div class="col-md-4 second-lot1">
                      <p class="Nom">Adresse : <span class="resultat">{{$medecin->adresse }}</span></p>
                     <p class="Nom">Localité : <span class="resultat">{{$medecin->ville->libelle }}</span></p>
                    <p class="Nom">Délegation : <span class="resultat">{{$medecin->delegation->libelle }}</span></p>
                    <p class="Nom">Gouvernaurat : <span class="resultat">{{$medecin->gouvernorat->libelle }}</span></p>
                    <p class="Nom">Mobile : <span class="resultat">{{$medecin->gsm }}</span></p>
                    <p class="Nom">Autres numéros : <span class="resultat">{{$medecin->fixe }}</span></p>
                    <p class="Nom">Site web : <span class="resultat">{{$medecin->site_web }}</span></p>
                          
                </div>


                <div class="col-md-4 third-lot1">
                          
                    <p class="Nom">Date d'inscription : <span class="resultat">
                    {{ date('d-m-Y', strtotime($date_insecrit)) }}</span></p>
                    <p class="Nom">Mode excercice : <span class="resultat">{{$medecin->mode->libelle }}</span></p>
                    <p class="Nom">Type Mode d'excercice : <span class="resultat">{{ $type_exercice }}</span></p>
                    <p class="cin">Etat actuel : <span class="resultat">  {{$medecin->typeEtat->libelle }}</span></p>
                    <p class="Nom">Diplôme : <span class="resultat">{{$medecin->diplome->libelle }}</span></p>
                    <p class="Nom">Année diplôme : <span class="resultat">{{ date('d-m-Y', strtotime($medecin->annee_diplome)) }}</span></p>
                    <p class="Nom">Spécialité : <span class="resultat">{{$medecin->specialite->libelle }}</span></p>
                    
                </div>

             </div>
             <a  class="btn btn-danger" style ="color:white;" id="clickmap" data-etap="1">
                       Position <i class="fas fa-map-marker"></i>
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
    var locations = <?php print_r(json_encode($medecin->position)) ?>;
    console.log(locations);
    var mymap = new GMaps({
      el: '#map',
      lat: 36.8468607,
      lng: 10.195749,
      zoom:10
    });
    mymap.addMarker({
      lat: locations.latitude,
      lng: locations.longitude,
    });
    }
    else
    $('#map').toggle();
    });
});
</script>

@endsection