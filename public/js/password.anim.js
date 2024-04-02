 $(function()
 {    
	$('#info_password').hide();
	$( "#password" ).click(function() 
	{
	  $( "#info_password" ).slideDown('400');
	});  
	$( "#Nom" ).click(function() 
	{
	  $( "#info_password" ).slideUp('400');
	});

	$( "#prenom" ).click(function() 
	{
	  $( "#info_password" ).slideUp('400');
	});

	$( "#email" ).click(function() 
	{
	  $( "#info_password" ).slideUp('400');
	});
});   
