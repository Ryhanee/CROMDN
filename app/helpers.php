<?php 

/**
*	Helper  
*/
// transformer le sexe du medecin a l'affichage en chaine de caréctere
if (!function_exists('transformGenre')) 
{
    /**
    * @return string
    */
    function transformGenre($genre)
    {
        if ($genre==0) 
        {
            return ('Femme');
        }
        else
        {
            return ('Homme');	
        }       
    }
}
// transformer le status de payment du cotisation a l'affichage en chaine de caréctere
if (!function_exists('transformPayment')) 
{
    /**
    * @return string
    */
    function transformPayment($status)
    {
        if ($status==0) 
        {
            return ('Impayé');
        }
        else
        {
            return ('Payé');   
        }       

    }
}
// transformer le recours du discipline a l'affichage en chaine de caréctere

if (!function_exists('transformRecours'))
{
    /**
    * @return string
    */
    function transformRecours($status)
    {
        if ($status==0)
        {
            return ('Non');
        }
        else
        {
            return ('Oui');
        }
    }
}