<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//middleware d'acce admins
Route::middleware(['access'])->group(function () {

//middleware d'acce au super admin
	Route::middleware(['super'])->group(function () {

		Route::post('/createUser', 'UserController@createUser')->name('createUser');

		Route::get('/showCreateUser', 'UserController@showCreateUser')->name('showCreateUser');

		Route::get('/showUpdateUser/{id}','UserController@showUpdateUser')->name('showUpdateUser');

		Route::post('/updateUser/{id}', 'UserController@updateUser')->name('updateUser');

		Route::get('/deleteUser/{id}', 'UserController@deleteUser')->name('deleteUser');

		Route::get('/showUsers', 'UserController@showUsers')->name('showUsers');

// fin middleware super admin
	});

//route Ajax

	Route::get('/delegationParGouvernorat/{id_gov}', 'Ajax\AjaxController@delegationParGouvernorat')->name('delegationParGouvernorat');

	Route::get('/villeParDelegation/{id_Del}', 'Ajax\AjaxController@villeParDelegation')
	->name('villeParDelegation');

	Route::get('/villeParGouvernorat/{id_gov}', 'Ajax\AjaxController@villeParGouvernorat')
	->name('villeParGouvernorat');

	//etat par mode d'exercice route
   Route::get('/etatParModeExercice/{id_mode}', 'Ajax\AjaxController@etatParModeExercice')
    ->name('etatParModeExercice');

    //route type exercice parmode exercice
Route::get('/typeParModeExercice/{id_mode}','Ajax\AjaxController@typeParModeExercice')
    ->name('typeParModeExercice');
//fin route Ajax

	Route::get('/Parametre', 'UserController@showParametre')->name('showParametre');

	Route::get('/showUser/{id}', 'UserController@showUser')->name('showUser');

	Route::get('/user/Reset', 'UserController@showResetPassword')->name('showResetPassword');

	Route::post('/user/resetPassword/{id}', 'UserController@resetPassword')->name('resetPassword');

	Route::get('/logout', 'UserController@handleLogout')->name('logout');

	Route::get('/home', 'UserController@showIndex')->name('showIndex');

	Route::get('/home/showCreate','MedecinController@showCreateMedecin')->name('showCreateMedecin');

	Route::get('/search/update/{id}','MedecinController@showUpdateMedecin')->name('showUpdateMedecin');

	Route::post('/createMedecin', 'MedecinController@createMedecin')->name('createMedecin');

	Route::post('/update/{id}','MedecinController@updateMedecin')->name('updateMedecin');

	Route::get('/delete/{id}','MedecinController@deleteMedecin')->name('deleteMedecin');

	Route::post('/search', 'MedecinController@searchSimple')->name('searchSimple');

	Route::get('/medecin/{id}', 'MedecinController@showMedecin')->name('showMedecin');

	//Route::post('/advanced','MedecinController@searchAdvanced')->name('searchAdvanced');

	Route::get('/advanced','MedecinController@searchAdvanced')->name('searchAdvanced');

    Route::post('/medecin/export/pdf', 'MedecinController@exportListeMedecins')->name('exportListeMedecins');

//routes cotisations et Tarif

	Route::get('/medecin/cotisation/{idMedecin}', 'CotisationController@showCotisations')->name('showCotisations');

	Route::post('/medecin/cotisation/update', 'CotisationController@updateCotisations')->name('updateCotisations');


	Route::get('/tarifs', 'CotisationController@showTarifs')->name('showTarifs');

	Route::get('/tarif/showCreate', 'CotisationController@showCreateTarif')->name('showCreateTarif');

	Route::post('/tarif/create', 'CotisationController@createTarif')->name('createTarif');

	Route::post('/tarif/update/{annee}', 'CotisationController@updateTarif')->name('updateTarif');

	Route::get('/tarif/delete/{annee}', 'CotisationController@deleteTarif')->name('deleteTarif');

	Route::get('/cotisation/showsearch/', 'CotisationController@showSearchCotisation')->name('showSearchCotisation');

    Route::post('/cotisation/search/', 'CotisationController@SearchCotisation')->name('SearchCotisation');

    Route::post('/cotisation/exportCotisationsImp/', 'CotisationController@exporterCotisationsImp')->name('exportCotisationsImpyees');



//fin routes cotisations et Tarifs

//routes Plaintes et concocations

	Route::get('/medecin/plainte/{idMedecin}', 'PlainteController@showPlaintes')->name('showPlaintes');

	Route::get('/medecin/plainte/showCreate/{idMedecin}','PlainteController@showCreatePlainte')->name('showCreatePlainte');

	Route::post('/medecin/plainte/create/{idMedecin}','PlainteController@createPlainte')->name('createPlainte');

	Route::get('/medecin/plainte/delete/{id}','PlainteController@deletePlainte')->name('deletePlainte');

	Route::get('/medecin/plainte/showUpdate/{idPlainte}','PlainteController@showUpdatePlainte')->name('showUpdatePlainte');

	Route::post('/medecin/plainte/update/{id}','PlainteController@updatePlainte')->name('updatePlainte');

	Route::get('/medecin/plainte/convocation/{id}', 'PlainteController@showConvocations')->name('showConvocations');

	Route::post('/medecin/plainte/convocation/create', 'PlainteController@createConvocation')->name('createConvocation');

	Route::get('/medecin/plainte/convocation/delete/{id}', 'PlainteController@deleteConvocation')->name('deleteConvocation');

Route::post('/medecin/plainte/convocation/update/{id}','PlainteController@updateConvocation')->name('updateConvocation');

//fin routes Plaintes et concocations

//routes Etats

Route::get('/medecin/etat/{idMedecin}', 'EtatController@showEtats')->name('showEtats');

Route::post('/medecin/etat/create','EtatController@createEtat')->name('createEtat');

Route::get('/medecin/etat/showUpdate/{id}','EtatController@showUpdateEtat')->name('showUpdateEtat');

Route::post('/medecin/etat/update/{id}','EtatController@updateEtat')->name('updateEtat');

Route::get('/medecin/etat/delete/{id}/{idMedecin}', 'EtatController@deleteEtat')->name('deleteEtat');

//fin routes Etats

//routes discipline

Route::get('/medecin/discipline/{idMedecin}', 'DisciplineController@showDisciplines')->name('showDisciplines');

Route::post('/medecin/discipline/create', 'DisciplineController@createDiscipline')->name('createDiscipline');

Route::post('/medecin/discipline/update/{id}', 'DisciplineController@updateDiscipline')->name('updateDiscipline');

Route::get('/medecin/discipline/delete/{id}', 'DisciplineController@deleteDiscipline')->name('deleteDiscipline');

//fin routes Etats

//routes Mail et SMS
Route::get('/search/formEmail/{id}', 'ContactController@formMail')->name('formMail');

Route::get('/medecin/sendEmail/{id}','ContactController@sendEMail')->name('sendEMail');

Route::post('/medecin/formEmails/', 'ContactController@formManyEmail')->name('formManyEmail');

Route::post('/medecin/sendEmails/', 'ContactController@sendManyEmail')->name('sendManyEmail');

Route::get('/search/showFormSMS/{id}', 'ContactController@showFormSMS')->name('showFormSMS');

Route::post('/medecin/sendMessage/',	'ContactController@sendMessage')->name('sendMessage');

Route::post('/medecin/formManySMS/', 'ContactController@formManySMS')->name('formManySMS');

Route::post('/medecin/sendMessages/', 'ContactController@sendMessages')->name('sendMessages');

Route::get('/listMedecins/{medecins}', 'ContactController@listMedecins')->name('listMedecins');

//fin routes Mail et SMS

//routes Documents

Route::get('search/document/{idMedecin}', 'DocumentController@showDocument')->name('showDocument');

Route::get('search/postale/{idMedecin}', 'DocumentController@showPostale')->name('showPostale');

Route::get('search/postale/pdf/{idMedecin}', 'DocumentController@generatePDFpostale')->name('generatePDFpostale');
Route::get('search/postale/pdfword/{idMedecin}', 'DocumentController@generateWORDpostale')->name('generateWORDpostale');

Route::get('search/lettre/{idMedecin}', 'DocumentController@showLettres')->name('showLettres');

Route::post('search/lettre/pdf', 'DocumentController@generatePDFlettre')->name('generatePDFlettre');

Route::get('search/attestation/{idMedecin}', 'DocumentController@showAttestation')->name('showAttestation');

Route::post('search/attestation/pdf', 'DocumentController@generatePDFasttestation')->name('generatePDFasttestation');

Route::post('search/attestation/word', 'DocumentController@generatePDFasttestation')->name('generatePDFasttestation');


Route::post('medecins/manyLettreRappel', 'DocumentController@manyLettre')->name('manyLettre');

Route::post('medecins/manyPostale', 'DocumentController@manyPostale')->name('manyPostale');

Route::post('medecins/manyPostalePerso', 'DocumentController@manyPostalePerso')->name('manyPostalePerso');



Route::post('medecins/exportCotisations', 'CotisationController@exportCotisations')->name('exportCotisations');



//fin routes Documents

// fin middleware admins

});

Route::get('/', function () { return view('welcome');})->name('welcome');

Route::get('/showLogin', 'UserController@showLogin')->name('login');

Route::post('/login', 'UserController@handleLogin')->name('handleLogin');
