$(function()
{
	$('#attestation').change(function()
	{
		var id=$('#attestation').val();
		console.log(id);
		if(id==10)
		{
			//$('#formulaire').empty();
			$('#formulaire').append('<label class="col-form-label">Date de convocation :</label><br>');
			$('#formulaire').append('<input type="text" name="rdv"><br>');
		}
		else
		{
			$('#formulaire').empty();
		}
	});
});


    document.addEventListener("DOMContentLoaded", function() {
    const downloadButtons = document.querySelectorAll("button[name^='download_']");
    downloadButtons.forEach(button => {
    button.addEventListener("click", function() {
    const documentType = button.getAttribute("name").replace("download_", "");
    document.getElementById("document_type").value = documentType;
});
});
});
