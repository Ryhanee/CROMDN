$(function()
{
//modal Update tarif
    $('[data-annee]').on('click',function(){
        var annee = $(this).data('annee');
       var montant = $(this).data('montant');
       $('#montantUpdate').val(montant);
       $('#anneeTarifUpdate').text("Année : " + annee);
        $('#formUpdate').attr('action',($('#formUpdate').attr('baseURL')+'/'+annee));    
    });
//modal convocation
$('[data-conv]').on('click',function(){
        var convocation = $(this).data('conv');
        var date = $(this).data('date');
        var observation = $(this).data('obser');
        $('#date').val(date);
        $('#observation').val(observation);
        $('#formUpdate').attr('action',($('#formUpdate').attr('baseURL')+'/'+convocation));  
    });

//update etat modal 

$('[data-id_etat]').on('click',function()
{
    var id_type =($(this).data('id_type'));
    var date =($(this).data('date'));
    var desc =($(this).data('desc'));
    var id = $(this).data('id_etat');
    var gouvernorat =($(this).data('gouvernorat'));
    var delegation =($(this).data('delegation'));
    var ville = ($(this).data('ville'));
    var addresse = ($(this).data('addresse'));
    var id_mode = ($(this).data('id_mode'));

    function updateTypeEtat(etat)
    {
        $('#typeEtatUpdate').empty();
        if(id_type != 10)
        {   
            
            $('#typeEtatUpdate').append('<option></option>');

            $(etat).each    
            (     
            function()
            {
                if(id_type===this.id) 
                {         
                    $('#typeEtatUpdate').append('<option value="' + this.id +'" selected>' + this.libelle + '</option>');
                }
                else
                {
                    $('#typeEtatUpdate').append('<option value="' + this.id +'">' + this.libelle + '</option>');
                }
            }
            );
        }
        else
        {
            $('#typeEtatUpdate').append('<option value="' + id_type +'">Inscription</option>');
        }
    }

    function updateDelegation(delegations)
    {
        $('#delegationEtat').empty();

        $(delegations).each 
        (   
            function()
            {   
                if(delegation===this.id) 
                {         
                    $('#delegationEtat').append('<option value="' + this.id +'" selected>' + this.libelle + '</option>');
                } 
                else
                {
                    $('#delegationEtat').append('<option value="' + this.id +'">' + this.libelle + '</option>');
                }   
            }
        );
    }

    function updateVille(villes)
    {
        $('#villeEtat').empty();
        
        $(villes).each
        (
            function()
            {           
                if(ville===this.id) 
                {         
                    $('#villeEtat').append('<option value="' + this.id +'" selected>' + this.libelle + '</option>');
                } 
                else
                {
                    $('#villeEtat').append('<option value="' + this.id +'">' + this.libelle + '</option>');
                }
            }
        );
    }

        url  = getRequestUrl() + 'etatParModeExercice/';
        url +=id_mode;
        $.getJSON(url,updateTypeEtat);

        if(gouvernorat)
        {
            urlDelegation  = getRequestUrl() + 'delegationParGouvernorat/';
            urlDelegation +=gouvernorat;
            $.getJSON(urlDelegation,updateDelegation);

            urlvilles  = getRequestUrl() + 'villeParDelegation/';
            urlvilles +=delegation;
            $.getJSON(urlvilles,updateVille);
        }
        else
        {
            $('#delegationEtat').empty();
            $('#villeEtat').empty();  
        }
        //Relation de selection entre Mode d'exercice et type des états
        $('#dateUpdate').val(date); 
        //$('#typeEtatUpdate').val(id_type); 
        $('#descUpdate').val(desc);
        $('#gouvernoratEtat').val(gouvernorat); 
        //$('#delegationEtat').val(delegation); 
        //$('#villeEtat').val(ville);
        $('#adresseEtat').val(addresse);

        //button Update 
        $('#formUpdateEtat').attr('action',$('#formUpdateEtat').attr('baseURL') +'/'+id);
}); 

//function update discipline modal

$('[data-id_discpline]').on('click',function(){

        
        var date =($(this).data('date'));
        var id_sanction =($(this).data('id_sanction'));
        var desc =($(this).data('desc'));
        var id = $(this).data('id_discpline');
        var reference = $(this).data('reference');
        var recours =$(this).data('recours');

        if(recours==1)
        {
            $('#oui').attr('checked', true);
        }
        else
        {
            $('#non').attr('checked', true);
        }

        $('#dateUpdate').val(date); 
        $('#sanctionUpdate').val(id_sanction); 
        $('#descUpdate').val(desc);
        $('#reference').val(reference);
        $('#formUpdateDiscpline').attr('action',($('#formUpdateDiscpline').attr('baseURL')+'/'+id));
        
    });
//affichage modal commentaire  plainte
$('[data-commentaire]').on('click',function(){
var commentaire = $(this).data('commentaire');
 $('#commentaire_plainte').empty();
 $('#commentaire_plainte').append(commentaire);
 //$('#commentaire_plainte').append(commentaire);
});
//affichage modal observation discipline
$('[data-observation_disciplines]').on('click',function(){
var observation = $(this).data('observation_disciplines');
console.log(observation);
$('#observation_disciplines').empty();
 $('#observation_disciplines').append(observation);
});
//affichage modal observation convocation
$('[data-observation_convocations]').on('click',function(){
var observation = $(this).data('observation_convocations');

$('#observation_convocations').empty();
 $('#observation_convocations').append(observation);
});
//affichage modal description etat
$('[data-description_etat]').on('click',function(){
var description = $(this).data('description_etat');
 $('#description_etat').empty();
 $('#description_etat').append(description);
});

});


