function updateDelegationEtat(delegations)
{
	$('#delegationEtat').empty();
	$('#villeEtat').empty();
	$('#delegationEtat').append('<option></option>');
	$('#villeEtat').append('<option></option>');

	$(delegations).each	
	( 	
		function()
		{		
			$('#delegationEtat').append('<option value="' + this.id +'">' + this.libelle + '</option>');
		}
	);
}

function updateVilleEtat(villes)
{
	$('#villeEtat').empty();
	$('#villeEtat').append('<option></option>');
	console.clear();
	$(villes).each
	(
		function()
		{			
			$('#villeEtat').append('<option value="' + this.id +'">' + this.libelle + '</option>');
		}
	);
}

$(function()
{
	//attacher un gestionnaire d'evnt pour remplir la liste des délégations 
	//du gouvernorat selectionné
	$('#gouvernoratEtat').on('change',function(){
		if($('#gouvernoratEtat').val())
		{
			url  = getRequestUrl() + 'delegationParGouvernorat/';
			url += $('#gouvernoratEtat').val();
			$.getJSON(url,updateDelegationEtat);
			//alert(url);
			urlvilles  = getRequestUrl() + 'villeParGouvernorat/';
			urlvilles += $('#gouvernoratEtat').val();
			$.getJSON(urlvilles,updateVilleEtat);	
		}
		else
		{
			$('#delegationEtat').empty();
			$('#villeEtat').empty();
		}	
	});
	//attacher un gestionnaire d'evnt pour remplir la liste des villes 
	//du delegation selectionné
	$('#delegationEtat').on('change',function(){

		if($('#delegationEtat').val())
		{	
			url  = getRequestUrl() + 'villeParDelegation/';
			url += $('#delegationEtat').val();	
		}
		else
		{
			url  = getRequestUrl() + 'villeParGouvernorat/';
			url += $('#gouvernoratEtat').val();	
		}

		$.getJSON(url,updateVilleEtat);		
	});
});