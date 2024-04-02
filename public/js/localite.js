function updateDelegation(delegations)
{
	$('#delegation').empty();
	$('#ville').empty();
	$('#delegation').append('<option ></option>');
	$('#ville').append('<option ></option>');

	$(delegations).each
	(
		function()
		{
			$('#delegation').append('<option value="' + this.id +'">' + this.libelle + '</option>');
		}
	);
}
function updateVille(villes)
{
	$('#ville').empty();
	$('#ville').append('<option ></option>');
	console.clear();
	$(villes).each
	(
		function()
		{

			$('#ville').append('<option value="' + this.id +'">' + this.libelle + '</option>');
		}
	);
}
//function de Relation de selection entre Mode d'exercice et type des états
function updateEtat(etat)
{
    $('#etat').empty();
    $('#etat').append('<option></option>');

    $(etat).each
    (
        function()
        {
            $('#etat').append('<option value="' + this.id +'">' + this.libelle + '</option>');
        }
    );
}
function updateTypeExercice(salaries)
{
	$('#type_exercice').empty();
	$('#type_exercice').append('<option></option>');
    $(salaries).each
    (
        function()
        {
            $('#type_exercice').append('<option value="' + this.id +'">' + this.libelle + '</option>');
        }
    );
}
$(function()
{
	//deselectionner le gouvernorat au cas ou l'utilisateur revient à la page par
	// le bouton précdent du navigateur
	     //$('#gouvernorat').children().first().attr('selected',true);
	//attacher un gestionnaire d'evnt pour remplir la liste des délégations
	//du gouvernorat selectionné
	$('#gouvernorat').on('change',function(){
		if($('#gouvernorat').val())
		{
			url  = getRequestUrl() + 'delegationParGouvernorat/';
			url += $('#gouvernorat').val();
			$.getJSON(url,updateDelegation);
			//alert(url);
			urlvilles  = getRequestUrl() + 'villeParGouvernorat/';
			urlvilles += $('#gouvernorat').val();
			$.getJSON(urlvilles,updateVille);
		}
		// else
		// {
		// 	$('#delegation').empty();
		// 	$('#ville').empty();
		// }
	});
	//deselectionner le delegation au cas ou l'utilisateur revient à la page par
	// le bouton précdent du navigateur
	    //$('#delegation').children().first().attr('selected',true);
	//attacher un gestionnaire d'evnt pour remplir la liste des villes
	//du delegation selectionné
	$('#delegation').on('change',function(){

		if($('#delegation').val())
		{
			url  = getRequestUrl() + 'villeParDelegation/';
			url += $('#delegation').val();
		}
		else
		{
			url  = getRequestUrl() + 'villeParGouvernorat/';
			url += $('#gouvernorat').val();
		}

		$.getJSON(url,updateVille);
	});

	//Relation de selection entre Mode d'exercice et type des états
	//$('#mode').children().first().attr('selected',true);

    $('#mode').on('change',function(){
        if($('#mode').val())
        {
            url  = getRequestUrl() + 'etatParModeExercice/';
            url += $('#mode').val();
            $.getJSON(url,updateEtat);
            //alert(url);
            //attacher un gestionnaire d'evnt pour remplir la liste des type
			//d'exercice du son mode
            urltype  = getRequestUrl() + 'typeParModeExercice/';
			urltype += $('#mode').val();
			$.getJSON(urltype,updateTypeExercice);
        }
        else
        {
            $('#etat').empty();
            $('#type_exercice').empty();
        }
    });


    //Relation de selection entre le sexe et le conjoint
      $('#epouse_balise').hide();
      $( 'input[name ="sexe"]').on( "click", function() {
      var sexe = $("input:checked").val();
      console.log(sexe);
      if(sexe == 1 )
      {
         $('#epouse_balise').hide();
      }
      if(sexe == 0 )
      {
          $('#epouse_balise').show();
      }
	  });




// Masquer le type mode d'exercice pour les modes "Autre" et "Libre pratique"

$('#type-mode-exercice').hide(); // on cache le champ par défaut
//le 1 ere valeur selecter
var val = $('#mode').val();
if(val == 2){
	// si "salarie"
	$('#type-mode-exercice').show();
	console.log(val);
}
else{
	$('#type-mode-exercice').hide();
}
$('#mode').change(function()
{
  // valeur sélectionnée
   var valeur = $(this).val();

    if(valeur == 2){
		// si "salarie"
		$('#type-mode-exercice').show();
           }

       else{
		$('#type-mode-exercice').hide();
       }
});
});
