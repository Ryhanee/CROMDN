<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Etat;
use App\Models\Type_etat;
use App\Models\Mode;
use App\Models\Gouvernorat;
use App\Models\Delegation;
use App\Models\Ville;
use Validator;

class EtatController extends Controller
{
// function d'afficher les etats
	public function showEtats($idMedecin)
	{
		$gouvernorats = Gouvernorat::orderBy('libelle', 'asc')->get();
		$delegations = Delegation::orderBy('libelle', 'asc')->get();
		$villes = Ville::orderBy('libelle', 'asc')->get();
		$medecin=Medecin::where('id',$idMedecin)->first();

		if($medecin->id_mode == 1)
		{
			$modes=Type_etat::whereHas('modes',function ($query) {
				$query->where('modes.id','1');})->orderBy('libelle', 'asc')->get();
		}
		elseif($medecin->id_mode == 2)
		{
			$modes=Type_etat::whereHas('modes',function ($query) {
				$query->where('modes.id','2');})->orderBy('libelle', 'asc')->get();
		}
		else
		{
			$modes=Type_etat::whereHas('modes',function ($query) {
				$query->where('modes.id','0');})->orderBy('libelle', 'asc')->get();
		}

	$etats=Etat::where('id_medecin',$idMedecin)->orderBy('date','desc')->paginate(5);

		return view('listEtats', compact('etats','medecin','modes','gouvernorats','delegations','villes'));
	}

    // function de création un etat

	public function createEtat()
	{
		$data=Input::all();
		$Medecin=Medecin::whereId($data['medecin'])->first();
		$modeEtat = $Medecin->id_mode;
		// $gouvernorat=gouvernorat::whereId($data['gouvernorat'])->first()->libelle;
		// $delegation=delegation::whereId($data['delegation'])->first()->libelle;
		// $ville=ville::whereId($data['ville'])->first()->libelle;
		//dd($data);

		if ($Medecin) 
		{
			Medecin::whereId($data['medecin'])->update([
				'etat_actuel'=>$data['typeEtat'],
				'adresse' => $data['adresse'],
         		'id_ville' => $data['ville'],
         		'id_delegation' => $data['delegation'],
         		'id_gouvernorat' => $data['gouvernorat'],
			]);

			Etat::create([
				'id_medecin'=>$data['medecin'],
				'date'=> $data['date'],
				'id_type' => $data['typeEtat'],
				'id_mode_type'=> $modeEtat ,
				'desc' => $data['description'],
				'id_gouvernorat' => $data['gouvernorat'],				
         		'id_delegation' => $data['delegation'],
         		'id_ville' => $data['ville'],         		
				'address' => $data['adresse'],
			]);
			return redirect()->back()->withErrors(['L\'opération a été effectuée avec succès']);
		}
		else
		{
			return redirect()->back()->withErrors(['Le medecin est Inexistant']);
		}
	}

//function editer un etat 

	public function updateEtat($id)
	{
		$data=Input::all();	
		$maxID=Etat::where('id_medecin',$data['medecin'])->max('id');
		Etat::whereId($id)->update([
			'date' => $data['date'],
			'id_type' => $data['typeEtat'],
			'desc' => $data['desc'],
			'address' =>$data['adresse'],
			'id_ville' => $data['ville'],
         	'id_delegation' => $data['delegation'],
         	'id_gouvernorat' => $data['gouvernorat'],
			]);

		if($maxID==$id)
		{
		Medecin::whereId($data['medecin'])->update([
			'etat_actuel'=>$data['typeEtat'],
			'adresse' => $data['adresse'],
         	'id_ville' => $data['ville'],
         	'id_delegation' => $data['delegation'],
         	'id_gouvernorat' => $data['gouvernorat'],
			]);
		}
		else
		{
			Medecin::whereId($data['medecin'])->update([
			'etat_actuel'=>$data['typeEtat']
			]);
		}
		return redirect()->back()->withErrors(['L\'opération a été effectuée avec succès']);
	}

 //function supprimer un etat

	public function deleteEtat($id,$idMedecin)
	{
		$maxID=Etat::where('id_medecin',$idMedecin)->max('id');
		
		Etat::whereId($id)->delete();

		if($maxID==$id)
		{		
			$idEtat=Etat::where('id_medecin',$idMedecin)->max('id');
			$etat=Etat::whereId($idEtat)->first();

			Medecin::whereId($idMedecin)->update([
			'etat_actuel'=>$etat->id_type,
			'adresse' => $etat->address,
         	'id_ville' => $etat->id_ville,
         	'id_delegation' => $etat->id_delegation,
         	'id_gouvernorat' => $etat->id_gouvernorat,
			]);
		}

		return redirect()->back()->withErrors(['L\'opération a été effectuée avec succès']);
	}
}
