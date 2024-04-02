$(function()
{
////////////////////getion des input de plainte
$('#nom-patient , #prenom-patient , #tel-patient ,#num-medecin').hide(); // on cache le champ par défaut
//le 1 ere valeur selecter
var valeur1 = $('#motif').val();
if(valeur1 == 3)
       { // si "medecin"
           $('#num-medecin').show();
           $('#nom-patient , #prenom-patient , #tel-patient').hide();
           }
       else if(valeur1 == 1 || valeur1 == 4)
       { // si "patient"
           $('#nom-patient, #prenom-patient, #tel-patient ' ).show();
           $('#num-medecin').hide();
       }
       else
       {
           $('#nom-patient , #prenom-patient , #tel-patient ,#num-medecin').hide();
       }
$('#motif').change(function()
{
   // lorsqu'on change de type de plaignant dans l'ajout du plainte
   var valeur = $(this).val(); // valeur sélectionnée
console.log(valeur);
       if(valeur == 3)
       { // si "medecin"
           $('#num-medecin').show();
           $('#nom-patient , #prenom-patient , #tel-patient').hide();
           }
       else if(valeur == 1 || valeur == 4)
       { // si "patient"
           $('#nom-patient, #prenom-patient, #tel-patient ' ).show();
           $('#num-medecin').hide();
       }
       else
       {
           $('#nom-patient , #prenom-patient , #tel-patient ,#num-medecin').hide();
       }
});
});