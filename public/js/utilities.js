'use strict';


function getRequestUrl()
{
	var requestUrl;

	requestUrl = "https://cromdn.business-mania.services/";
	return requestUrl;
}

function getWwwUrl()
{
	var wwwUrl;

	/*
	 * Création de l'équivalent de la variable de template PHP $wwwUrl
	 * contenant l'URL du dossier www.
	 *
	 * Cette variable permet de créer des URLs vers des fichiers statiques.
	 */
	wwwUrl = window.location.href;
	wwwUrl = wwwUrl.substr(0, wwwUrl.indexOf('/index.php')) + '/application/www';

	return wwwUrl;
}

// La fonction renvoie vrai si l'argument est un nombre entier
function isInteger(value)
{   
    return Number.isInteger(value);
    
     
}

// La fonction renvoie l'inverse de isNaN() de JavaScript
function isNumber(value)
{
    // TODO: implémenter la fonction
    return (!isNaN(value));
   
}
