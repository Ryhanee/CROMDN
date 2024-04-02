<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delegation;
use App\Models\Ville;
use App\Models\Medecin;
use App\Models\Type_etat;
use App\Models\Type_mode_exercice;

class AjaxController extends Controller
{

    // fonctions pour faitre des coherence entre gouvernorats, delegations et ces ville 
    function delegationParGouvernorat($id_gov)
    {
        $delegations = Delegation::where('ref_gouvernaurat',$id_gov)->orderBy('libelle', 'asc')->get();
        echo json_encode($delegations);
    }

    function villeParDelegation($id_Del)
    {
        if(!empty($id_Del))
        {
            $villes = Ville::where('ref_delegation',$id_Del)->orderBy('libelle', 'asc')->get();
        }
        else
        {
            $villes = Ville::where('ref_delegation',' like ', '%')->orderBy('libelle', 'asc')->get();    
        } 
        
        echo json_encode($villes);
    }

    function villeParGouvernorat($id_gov)
    {
        $villes = Ville::where('ref_gouvernaurat',$id_gov)->orderBy('libelle', 'asc')->get();
        echo json_encode($villes);
    }

    //liasant mode avec etat

    function etatParModeExercice($id_mode)
    {
       //$etat = Mode_type::where('id_mode_exercice',$id_mode)->get();
       if($id_mode == 1)
       {
           $etat=Type_etat::whereHas('modes',function ($query) {
               $query->where('modes.id','1');})->orderBy('libelle', 'asc')->get();
       }
       elseif($id_mode == 2)
       {
           $etat=Type_etat::whereHas('modes',function ($query) {
               $query->where('modes.id','2');})->orderBy('libelle', 'asc')->get();
       }
       else
       {
           $etat=Type_etat::whereHas('modes',function ($query) {
               $query->where('modes.id','0');})->orderBy('libelle', 'asc')->get();
       }
       echo json_encode($etat);
    }

    function typeParModeExercice($id_mode)
    {
      $mode=$id_mode;
      $salaries = Type_mode_exercice::where('id_mode',$mode)->orderBy('libelle', 'asc')->get();
        echo json_encode($salaries);
    }

}
