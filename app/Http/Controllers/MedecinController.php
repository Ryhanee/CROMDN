<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Medecin;
use App\Models\User;
use App\Models\Ville;
use App\Models\Delegation;
use App\Models\Gouvernorat;
use App\Models\Nationalite;
use App\Models\Type_etat;
use App\Models\Exercice;
use App\Models\Specialite;
use App\Models\Diplome;
use App\Models\Mode;
use App\Models\Type_mode_exercice;
use App\Models\Etat;
use App\Models\Cotisation;
use App\Models\Tarif;
use App\Models\Position;
use Carbon\Carbon;
use Validator;
use Mail;
use Illuminate\Support\Facades\URL;
use PDF;

class MedecinController extends Controller
{

    public function showCreateMedecin()
    {
        //dd(old('nom'));
        $a = old('gouvernorat');
        $b = old('delegation');
        //dd($b);
        $villes = Ville::where('ref_delegation', old('delegation'))->orderBy('libelle', 'asc')->get();
        $delegations = Delegation::where('ref_gouvernaurat', $a)->orderBy('libelle', 'asc')->get();


        //dd(old('delegation'));
        //dd($delegations);
        $gouvernorats = Gouvernorat::orderBy('libelle', 'asc')->get();
        $nationalites = Nationalite::orderBy('libelle', 'asc')->get();
        $etats = Type_etat::orderBy('libelle', 'asc')->get();
        $specialites = Specialite::orderBy('libelle', 'asc')->get();
        $diplomes = Diplome::orderBy('libelle', 'asc')->get();
        $modes = Mode::orderBy('libelle', 'asc')->get();//mode exercice
        $salaries = Type_mode_exercice::orderBy('libelle', 'asc')->get();

        return view('formCreateMedecin', compact('villes', 'delegations', 'gouvernorats', 'nationalites', 'etats', 'specialites', 'diplomes', 'modes', 'salaries'));
    }

    public function createMedecin()
    {
        $tarif = Tarif::where('annee', 2010)->first()->montant;

        $data = Input::all();

        $medecin = Medecin::whereId($data['num_inscerit'])->first();


        if ($medecin == null) {
            $rules = [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'email' => 'required|string|email|max:55|',
                'date_naissance' => 'required',
                'gsm' => 'required',
                'sexe' => 'required',
                'adresse' => 'required',
                'ville' => 'required',
                'delegation' => 'required',
                'gouvernorat' => 'required',
                'nationalite' => 'required',
                'mode' => 'required',
                'specialite' => 'required',
                'diplome' => 'required',
                'annee_diplome' => 'required',
            ];

            $messages = [

                'nom.required' => 'Votre nom est obligatoire',
                'prenom.required' => 'Votre prenom est obligatoire',
                'email.required' => 'le champ E-mail est obligatoire',
                'date_naissance.required' => 'Votre date de naissance est obligatoire',
                'gsm.required' => 'Votre mobile est obligatoire',
                'sexe.required' => 'Le champ sexe est obligatoire',
                'adresse.required' => 'Voter adresse est obligatoire',
                'ville.required' => 'Le champ ville est obligatoire ',
                'delegation.required' => 'Le champ delegation est obligatoire',
                'gouvernorat.required' => 'Le champ gouvernorat est obligatoire',
                'nationalite.required' => 'Votre nationalite est obligatoire',
                'mode.required' => 'Le mode est obligatoire',
                'specialite.required' => 'La specialite est obligatoire',
                'diplome.required' => 'Votre diplome est obligatoire ',
                'annee_diplome.required' => 'L\'annee de diplome est obligatoire',

            ];
            $validation = Validator::make($data, $rules, $messages);
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }
            if ($data['date_inscrit'] > $data['annee_diplome']) {

                Medecin::create([
                    'id' => $data['num_inscerit'],
                    'email' => $data['email'],
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'date_naissance' => $data['date_naissance'],
                    'lieu_naissance' => $data['lieu_naissance'],
                    'gsm' => $data['gsm'],
                    'fixe' => $data['fixe'],
                    'sexe' => $data['sexe'],
                    'adresse' => $data['adresse'],
                    'id_ville' => $data['ville'],
                    'id_delegation' => $data['delegation'],
                    'id_gouvernorat' => $data['gouvernorat'],
                    'id_nationalite' => $data['nationalite'],
                    'id_mode' => $data['mode'],
                    'id_type_mode' => $data['type_exercice'],
                    'id_specialite' => $data['specialite'],
                    'id_diplome' => $data['diplome'],
                    'annee_diplome' => $data['annee_diplome'],
                    'site_web' => $data['site_web'],
                    'epouse' => $data['epouse'],
                    'etat_actuel' => 10,
                ]);

                Position::create([
                    'id_medecin' => $data['num_inscerit'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]);

                Etat::create([
                    'id_medecin' => $data['num_inscerit'],
                    'date' => $data['date_inscrit'],
                    'address' => $data['gouvernorat'] . ' ' . $data['delegation'] . ' ' . $data['ville'] . ' ' . $data['adresse'],
                    'id_type' => 10,
                    'id_mode_type' => $data['mode'],
                ]);

                $now = Carbon::now()->format('Y');
                $date_inscrit = (new Carbon($data['date_inscrit']))->format('Y');
                //$years=$now->diffInYears($date_inscrit);

                if ($date_inscrit <= $now) {
                    for ($i = $date_inscrit; $i <= $now; $i++) {
                        $montant = Tarif::where('annee', $i)->first()->montant;

                        Cotisation::create([
                            'id_medecin' => $data['num_inscerit'],
                            'annee' => $i,
                            'montant' => $montant,
                            'payment' => 0,
                        ]);

                    }
                }
                return redirect(route('showIndex'))->withErrors(['L\'opération a été effectuée avec succès']);
            } else {

                return redirect()->back()->withInput()->withErrors(['date' => 'La date du diplôme doit être antérieur à la date d\'inscription']);

            }
        } else {

            return redirect()->back()->withInput()->withErrors(['id' => 'Numéro d\'inscription existe déja']);
        }
    }

    public function showUpdateMedecin($id)
    {


        $nationalites = Nationalite::orderBy('libelle', 'asc')->get();
        $etats = Type_etat::orderBy('libelle', 'asc')->get();
        $exercices = Exercice::orderBy('libelle', 'asc')->get();
        $specialites = Specialite::orderBy('libelle', 'asc')->get();
        $diplomes = Diplome::orderBy('libelle', 'asc')->get();
        $modes = Mode::orderBy('libelle', 'asc')->get();
        $salaries = Type_mode_exercice::orderBy('libelle', 'asc')->get();
        $medecin = Medecin::whereId($id)->first();
        $gouvernorats = Gouvernorat::orderBy('libelle', 'asc')->get();
        $delegations = Delegation::where('ref_gouvernaurat', $medecin->id_gouvernorat)->orderBy('libelle', 'asc')->get();
        $villes = Ville::where('ref_delegation', $medecin->id_delegation)->orderBy('libelle', 'asc')->get();
        $date_insecrit = Etat::where('id_medecin', $id)->where('id_type', 10)->first()->date;

        if ($medecin->position) {
            $latitude = $medecin->position->latitude;
            $longitude = $medecin->position->longitude;
        } else {
            $latitude = '';
            $longitude = '';
        }
        return view('formUpdateMedecin', compact('medecin', 'villes', 'delegations', 'gouvernorats', 'nationalites', 'etats', 'exercices', 'specialites', 'diplomes', 'modes', 'salaries', 'date_insecrit', 'latitude', 'longitude'));
    }

    public function updateMedecin($id)
    {
        $data = Input::all();

        $newId = $data['num_inscerit'];

        $medecin = Medecin::whereId($data['num_inscerit'])->first();

        if ($medecin == null || $medecin->id == $id) {

            $rules = [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'email' => 'required|string|email|max:55|',
                'date_naissance' => 'required',
                'sexe' => 'required',
                'adresse' => 'required',
                'ville' => 'required',
                'delegation' => 'required',
                'gouvernorat' => 'required',
                'nationalite' => 'required',
                'mode' => 'required',
                'specialite' => 'required',
                'diplome' => 'required',
                'annee_diplome' => 'required',
            ];
            $messages = [
                'nom.required' => 'Votre nom est obligatoire',
                'prenom.required' => 'Votre prenom est obligatoire',
                'email.required' => 'le champ E-mail est obligatoire',
                'date_naissance.required' => 'Votre date de naissance est obligatoire',
                'sexe.required' => 'Le champ sexe est obligatoire',
                'adresse.required' => 'Voter adresse est obligatoire',
                'ville.required' => 'Le champ ville est obligatoire ',
                'delegation.required' => 'Le champ delegation est obligatoire',
                'gouvernorat.required' => 'Le champ gouvernorat est obligatoire',
                'nationalite.required' => 'Votre nationalite est obligatoire',
                'mode.required' => 'Le mode est obligatoire',
                'specialite.required' => 'La specialite est obligatoire',
                'diplome.required' => 'Votre diplome est obligatoire ',
                'annee_diplome.required' => 'L\'annee de diplome est obligatoire',
            ];
            $validation = Validator::make($data, $rules, $messages);
            if ($validation->fails()) {
                return redirect(route('showUpdateMedecin', $newId))->withErrors($validation->errors());
            } elseif ($data['date_inscrit'] > $data['annee_diplome']) {


                $etat_insecrit = Etat::where('id_medecin', $newId)->where('id_type', 10)->first();
                $oldDate = (new Carbon($etat_insecrit->date))->format('Y');

                Medecin::whereId($id)->update([
                    'id' => $newId,
                    'email' => $data['email'],
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'date_naissance' => $data['date_naissance'],
                    'lieu_naissance' => $data['lieu_naissance'],
                    'gsm' => $data['gsm'],
                    'fixe' => $data['fixe'],
                    'sexe' => $data['sexe'],
                    'adresse' => $data['adresse'],
                    'id_ville' => $data['ville'],
                    'id_delegation' => $data['delegation'],
                    'id_gouvernorat' => $data['gouvernorat'],
                    'id_nationalite' => $data['nationalite'],
                    //'id_exercice' => $data['exercice'],
                    'id_mode' => $data['mode'],
                    'id_type_mode' => $data['type_exercice'],
                    'id_specialite' => $data['specialite'],
                    'id_diplome' => $data['diplome'],
                    'annee_diplome' => $data['annee_diplome'],
                    'site_web' => $data['site_web'],
                    'epouse' => $data['epouse'],
                ]);

                //update position medecin

                Position::where('id_medecin', $id)->update([
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]);

                //update date de l'inscription dans le table etat

                $etat_insecrit->update(['date' => $data['date_inscrit']]);

                //update les années du cotisation selon Update de la date du l'inscription
                $newDate = (new Carbon($data['date_inscrit']))->format('Y');

                if ($oldDate < $newDate) {
                    for ($i = $oldDate; $i <= $newDate; $i++) {
                        Cotisation::Where('id_medecin', $newId)->Where('annee', $i)->delete();
                    }
                } elseif ($oldDate > $newDate) {
                    for ($i = $newDate; $i <= $oldDate; $i++) {
                        $montant = Tarif::where('annee', $i)->first()->montant;
                        Cotisation::create([
                            'id_medecin' => $newId,
                            'annee' => $i,
                            'montant' => $montant,
                            'payment' => 0,
                        ]);
                    }
                }
                return redirect(route('showUpdateMedecin', $newId))->withErrors(['L\'opération a été effectuée avec succès']);
            } // elseif($data['date_inscrit'] < $data['annee_diplome'])
            else {

                return redirect(route('showUpdateMedecin', $newId))->withErrors(['La date du diplôme doit être antérieur à la date d\'inscription']);

            }
        } else {
            dd(A);
            return redirect()->back()->withErrors(['Numéro d\'inscription  existe déja ']);
        }
    }

    public function deleteMedecin($id)
    {
        Medecin::whereId($id)->delete();
        return redirect(route('showIndex'))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function searchSimple()
    {
        $data = Input::all();
// dd($data['numinscrit']);
        if ($data['numinscrit'] != null) {
            return $this->showMedecin($data['numinscrit']);
        } else {
            return redirect(route('showIndex'))->withErrors(['Vous devez saisir le N° Inscription ']);
        }
    }

    public function showMedecin($id)
    {
        $medecin = Medecin::whereId($id)->first();

//dd($type_exercice);
        if ($medecin) {
            $position = Position::where('id_medecin', $id)->get();

            if ($medecin->id_type_mode) {
                $type_exercice = $medecin->type_exercice->libelle;
            } else {
                $type_exercice = '';
            }

            $date_insecrit = Etat::where('id_medecin', $id)->where('id_type', 10)->first()->date;
            return view('profile', compact('medecin', 'date_insecrit', 'position', 'type_exercice'));
        } else {
            return redirect(route('showIndex'))->withErrors(['Le medecin est Inexistant']);
        }

    }

    public function searchAdvanced(Request $request)
    {
        $data = Input::all();
        // if(empty($request->input('ville')))
        // {

        //    $villeParam = ['like','%'.$request->input('ville')];
        // }
        // else
        // {
        //    $villeParam  = [$request->input('ville')];
        // }

        $medecins = Medecin::where('nom', 'like', '%' . $request->input('nom') . '%')->
        Where('prenom', 'like', '%' . $request->input('prenom') . '%')->
        whereDate('date_naissance', 'like', '%' . $request->input('date_naissance') . '%')->Where('gsm', 'like', '%' . $request->input('gsm') . '%')->
        Where('adresse', 'like', '%' . $request->input('adresse') . '%');


        if (empty($request->input('ville'))) {
            $medecins = $medecins->Where('id_ville', 'like', '%' . $request->input('ville'));
        } else {
            $medecins = $medecins->Where('id_ville', $request->input('ville'));
        }

        if (empty($request->input('delegation'))) {
            $medecins = $medecins->Where('id_delegation', 'like', '%' . $request->input('delegation'));
        } else {
            $medecins = $medecins->Where('id_delegation', $request->input('delegation'));
        }

        if (empty($request->input('specialite'))) {
            $medecins = $medecins->Where('id_specialite', 'like', '%' . $request->input('specialite'));
        } else {
            $medecins = $medecins->Where('id_specialite', $request->input('specialite'));
        }

        if (!empty($request->input('etat'))) {
            $medecins = $medecins->Where('etat_actuel', $data['etat']);
        }

        if (!empty($request->input('type_exercice'))) {
            $medecins = $medecins->Where('id_type_mode', $request->input('type_exercice'));
        }

        $medecins = $medecins->
        Where('id_gouvernorat', 'like', '%' . $request->input('gouvernorat') . '%')->
        Where('sexe', 'like', '%' . $request->input('sexe') . '%')->
        Where('id_mode', 'like', '%' . $request->input('mode') . '%');

        $medecinsGet = $medecins->get();
        $medecinsPaginate = $medecins->paginate(5);
        //dd($medecinsPaginate);

        $medecinsPaginate->withPath(URL::full());
        $idMedecins = $medecinsGet->implode('id', ', ');
        if ($idMedecins) {
            //dd('true');
            $idM = explode(" ", $idMedecins);
            $locations = Position::whereIn('id_medecin', $idM)->get();
            //dd($request->input(),$medecins,Medecin::whereId(1)->first());
            return view('listMedecins', ['medecins' => $medecinsPaginate, 'locations' => $locations, 'medecinsGet' => $medecinsGet]);
        } else {
            //dd('false');
            return redirect(route('showIndex'))->withErrors(['Aucun Médecin dentiste existe']);
        }
    }

    public function exportListeMedecins()
    {

        $data = Input::all();
        $medecins = $data['medecins'];
        $IdMedecins = explode(" ", $medecins);
        //dd($IdMedecins);

        if ($medecins) {
            $IdMedecins = explode(" ", $medecins);
            $List_PDF = [];

            foreach ($IdMedecins as $medecinId) {
                $medecin = Medecin::findOrFail($medecinId); // Using findOrFail to handle if medecin is not found
                $List_PDF[] = $medecin;
            }

            $html = '<table style="width: 100%;">';
            $html .= '<thead>';
            $html .= '<tr style="background: #adb5bd;">';
            $html.=  '<th scope="col">N° Inscription</th>';
            $html.=  '<th scope="col">Nom</th>';
            $html.=  '<th scope="col">Prénom</th>';
            $html.=  '<th scope="col">Localité</th>';
            $html.=  '<th scope="col">Adresse</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            // Ajouter les données des médecins
            foreach ($List_PDF as $medecin) {

                $html .= '<tr>';
                $html .= '<td >' . $medecin['id'] . '</td>';
                $html .= '<td>' . $medecin['nom'] . ' </td>';
                $html .= '<td>' . $medecin['prenom'] . '</td>';
                $html .= '<td>' . $medecin['ville']['libelle'] . '</td>';
                $html .= '<td>' . $medecin['adresse'] . '</td>';
                $html .= '</tr>';

            }
            $html .= '</tbody>';
            $html .= '</table>';

        } else {
            $html = '<tr><td colspan="5">Aucun médecin trouvé</td></tr>';
        }

       // dd($html);

        $pdf = PDF::loadHtml($html)->setPaper('letter', 'landscape');
// Download the PDF
        return $pdf->download('medecins.pdf');
    }

}
