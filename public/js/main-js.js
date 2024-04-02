$(function()
{
    // gestion des link active de navbar
  	    var current = location.pathname;
    $('#nav li a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    });
    ////////////////////getion des erreurs
   $('.gestion-erreur').fadeOut(4000);
     
});