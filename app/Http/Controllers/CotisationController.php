<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Cotisation;
use App\Models\Tarif;
use Carbon\Carbon;

class CotisationController extends Controller
{

    public function showCotisations($idMedecin)
    {
        $medecin=Medecin::where('id',$idMedecin)->first();
        $allCotisation = Cotisation::where('id_medecin',$idMedecin)->orderBy('annee','desc')->get();
        $cotisations=Cotisation::where('id_medecin',$idMedecin)->orderBy('annee','desc')->paginate(5);
        $cotisationsPaye = Cotisation::where('id_medecin',$idMedecin)->where('payment',1)->get();
        $lastYear = $cotisationsPaye->max('annee');
        $firstYear = $cotisationsPaye->min('annee');

        $cotisationsNonPaye = Cotisation::where('id_medecin',$idMedecin)->where('payment',0)->get();
        $somme = $cotisationsNonPaye->sum('montant');

    	//dd($somme);
        return view('listCotisations', compact('cotisations','medecin','lastYear','allCotisation','somme'));
    }

    public function updateCotisations(Request $request)
    {

        $data = Input::all();

        $IdMedecin = $data['medecin'];
        $annee = $data['annee'];
         //dd($annee);
        $allCotisation=Cotisation::where('id_medecin',$IdMedecin)->get();



        foreach ($allCotisation as $cotisation)
            {

            if($cotisation->annee <= $annee)
                {
                    $cotisation->update(['payment' =>'1']);
                }
            else
                {
                    $cotisation->update(['payment' =>'0']);
                }
            }



        return redirect(route('showCotisations',$IdMedecin))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function showTarifs()
    {
        $tarifs=Tarif::orderBy('annee','desc')->paginate(5);;
        return view('listTarifs', ['tarifs' => $tarifs]);
    }

    public function showCreateTarif()
    {
        return view('formCreateTarif');
    }

    public function createTarif(Request $request)
    {
      $medecins=Medecin::all();
      $anneeExist=Tarif::where('annee',date("Y"))->first();

        if(!$anneeExist)
        {
            Tarif::create([
                    'annee' => date("Y"),
                    'montant' => $request->input('montant'),
                ]);

            foreach($medecins as $medecin)
            {
            $cotisations=Cotisation::create([
                    'id_medecin' => $medecin->id,
                    'annee' => date("Y"),
                    'montant' => $request->input('montant'),
                    'payment' => 0,

                ]);
            }

            return redirect(route('showTarifs'))->withErrors(['L\'opération a été effectuée avec succès']);
        }
        else
        {
            return redirect(route('showTarifs'))->withErrors(['L\'année déja existante']);
        }
    }

    public function updateTarif($annee)
    {
        $data = Input::all();

        Tarif::where('annee',$annee)->update([
            'montant' => $data['montant'],
        ]);

        cotisation::where('annee',$annee)->update([
            'montant' => $data['montant'],
        ]);

        return redirect(route('showTarifs'))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function deleteTarif($annee)
    {
        Tarif::where('annee',$annee)->delete();
        return redirect(route('showTarifs'))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function showSearchCotisation()
    {
        return view('showSearchCotisation');
    }

    public function SearchCotisation()
    {
         $data = Input::all();
        // $now = Carbon::now()->format('Y');;
        // dd($now);
        $Anne_in =  $data['anne_in'];
        $Anne_out = $data['anne_out'];
        $status =   $data['status'];

        if($Anne_in<$Anne_out)
        {
            $medecins=Medecin::whereHas('cotisation',function ($query) use ($status,$Anne_in,$Anne_out)
            {
              $query->where('payment',$status)->whereBetween('annee', [$Anne_in,
                $Anne_out]);
            },'>',2)->get();
            //dd($medecins);
            if($medecins->isNotEmpty()) {
                return view('listMedecinsCotisation',compact('medecins'));
            }
            else {
            return redirect(route('showSearchCotisation'))->withErrors(['Aucun Médecin dentiste existe']);
            }
        }
        else
        {
            return redirect()->back()->withErrors(['L\'année 1 doit être antérieure à la année 2']);
        }
    }

    public function SommeCotisation($idMedecin) {

        $cotisationsNonPaye = Cotisation::where('id_medecin',$idMedecin)->where('payment',0)->get();
        $somme = $cotisationsNonPaye->sum('montant');

        //dd($firstYear);
        return view('sommeCotisations', compact('somme'));

    }

}
