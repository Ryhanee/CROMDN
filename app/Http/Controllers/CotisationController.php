<?php

namespace App\Http\Controllers;

use App\Models\Lettre;
use App\Models\Numerola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Cotisation;
use App\Models\Tarif;
use Carbon\Carbon;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PDF;

class CotisationController extends Controller
{

    public function showCotisations($idMedecin)
    {
        $medecin = Medecin::where('id', $idMedecin)->first();
        $allCotisation = Cotisation::where('id_medecin', $idMedecin)->orderBy('annee', 'desc')->get();
        $cotisations = Cotisation::where('id_medecin', $idMedecin)->orderBy('annee', 'desc')->paginate(5);
        $cotisationsPaye = Cotisation::where('id_medecin', $idMedecin)->where('payment', 1)->get();
        $lastYear = $cotisationsPaye->max('annee');
        $firstYear = $cotisationsPaye->min('annee');

        $cotisationsNonPaye = Cotisation::where('id_medecin', $idMedecin)->where('payment', 0)->get();
        $somme = $cotisationsNonPaye->sum('montant');

        //dd($somme);
        return view('listCotisations', compact('cotisations', 'medecin', 'lastYear', 'allCotisation', 'somme'));
    }

    public function updateCotisations(Request $request)
    {

        $data = Input::all();

        $IdMedecin = $data['medecin'];
        $annee = $data['annee'];
        //dd($annee);
        $allCotisation = Cotisation::where('id_medecin', $IdMedecin)->get();


        foreach ($allCotisation as $cotisation) {

            if ($cotisation->annee <= $annee) {
                $cotisation->update(['payment' => '1']);
            } else {
                $cotisation->update(['payment' => '0']);
            }
        }


        return redirect(route('showCotisations', $IdMedecin))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function showTarifs()
    {
        $tarifs = Tarif::orderBy('annee', 'desc')->paginate(5);;
        return view('listTarifs', ['tarifs' => $tarifs]);
    }

    public function showCreateTarif()
    {
        return view('formCreateTarif');
    }

    public function createTarif(Request $request)
    {
        $medecins = Medecin::all();
        $anneeExist = Tarif::where('annee', date("Y"))->first();

        if (!$anneeExist) {
            Tarif::create([
                'annee' => date("Y"),
                'montant' => $request->input('montant'),
            ]);

            foreach ($medecins as $medecin) {
                $cotisations = Cotisation::create([
                    'id_medecin' => $medecin->id,
                    'annee' => date("Y"),
                    'montant' => $request->input('montant'),
                    'payment' => 0,

                ]);
            }

            return redirect(route('showTarifs'))->withErrors(['L\'opération a été effectuée avec succès']);
        } else {
            return redirect(route('showTarifs'))->withErrors(['L\'année déja existante']);
        }
    }

    public function updateTarif($annee)
    {
        $data = Input::all();

        Tarif::where('annee', $annee)->update([
            'montant' => $data['montant'],
        ]);

        cotisation::where('annee', $annee)->update([
            'montant' => $data['montant'],
        ]);

        return redirect(route('showTarifs'))->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function deleteTarif($annee)
    {
        Tarif::where('annee', $annee)->delete();
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
        $Anne_in = $data['anne_in'];
        $Anne_out = $data['anne_out'];
        $status = $data['status'];

        if ($Anne_in < $Anne_out) {
            $medecins = Medecin::whereHas('cotisation', function ($query) use ($status, $Anne_in, $Anne_out) {
                if (empty($status)) {
                    $query->whereBetween('annee', [$Anne_in,
                        $Anne_out]);
                } else {
                    $query->where('payment', $status)->whereBetween('annee', [$Anne_in,
                        $Anne_out]);
                }

            }, '>', 2)->get();
            //dd($medecins);
            if ($medecins->isNotEmpty()) {
                return view('listMedecinsCotisation', compact('medecins', 'Anne_in', 'Anne_out', 'status'));
            } else {
                return redirect(route('showSearchCotisation'))->withErrors(['Aucun Médecin dentiste existe']);
            }
        } else {
            return redirect()->back()->withErrors(['L\'année 1 doit être antérieure à la année 2']);
        }
    }

    public function SommeCotisation($idMedecin)
    {

        $cotisationsNonPaye = Cotisation::where('id_medecin', $idMedecin)->where('payment', 0)->get();
        $somme = $cotisationsNonPaye->sum('montant');

        //dd($firstYear);
        return view('sommeCotisations', compact('somme'));

    }

    public function exportCotisations(Request $request)
    {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        set_time_limit(450);

        $data = Input::all();
        $annee_debut = $data['anne_debut'];
        $annee_fin = $data['anne_fin'];
        $status = $data['status'];

        $medecins = $data['medecins'];
        if ($medecins) {
            $IdMedecins = explode(" ", $medecins);
            $List_PDF = [];

            foreach ($IdMedecins as $medecinId) {
                $medecin = Medecin::findOrFail($medecinId); // Using findOrFail to handle if medecin is not found
                $cotisations = Cotisation::where('id_medecin', $medecin->id);

                if (empty($status)) {
                    $cotisations->whereBetween('annee', [$annee_debut, $annee_fin]);
                } else {
                    $cotisations->where('payment', $status)
                        ->whereBetween('annee', [$annee_debut, $annee_fin]);
                }


                $cotisations = $cotisations->get();

                // Create an array to store cotisations details for each medecin
                $cotisationsData = [
                    'medecin_name' => $medecin->nom . ' ' . $medecin->prenom,
                    'cotisations' => [],
                ];

                foreach ($cotisations as $cotisation) {
                    // Push les cotisations dans un array
                    $cotisationsData['cotisations'][$cotisation->annee] = $cotisation->montant;
                }


                $List_PDF[] = $cotisationsData;
            }

            $html = '<table>';
            $html .= '<thead>';
            $html .= '<tr style="background: #adb5bd;">';
            $html .= '<th>Num</th><th>Nom medecin</th>';

            // Ajouter les en-têtes d'année
            for ($annee = $annee_debut; $annee <= $annee_fin; $annee++) {
                $html .= '<th>' . $annee . '</th>';
            }
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $num = 0;

            // Ajouter les données des médecins
            foreach ($List_PDF as $medecinData) {
                $html .= '<tr>';
                $html .= '<td>' . $num . '</td>';
                $html .= '<td>' . $medecinData['medecin_name'] . '</td>';

                // Boucler à travers chaque année
                for ($annee = $annee_debut; $annee <= $annee_fin; $annee++) {
                    // Vérifier si une cotisation existe pour cette année
                    if (isset($medecinData['cotisations'][$annee])) {
                        $html .= '<td>' . $medecinData['cotisations'][$annee] . '</td>';
                    } else {
                        $html .= '<td></td>';
                    }
                }
                $num++;


                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';

            //dd($html);

            // Générer le PDF avec dompdf et mettre le mode landscape

            $pdf = PDF::loadHtml($html)->setPaper('letter', 'landscape');
// Download the PDF
            return $pdf->download('journal-cotisations.pdf');

        } else {
            return redirect()->back();
        }
    }

    public function exporterCotisationsImp(Request $request)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        set_time_limit(450);

        $data = $request->all();
        $annee_debut = $data['anne_in'];
        $annee_fin = $data['anne_out'];
        $status = $data['status'];
        $nbr_annee = $data['nbr_annee'];


        if ($annee_debut < $annee_fin) {
            $medecins = Medecin::whereHas('cotisation', function ($query) use ($status, $annee_debut, $annee_fin) {
                if (empty($status)) {
                    $query->whereBetween('annee', [$annee_debut, $annee_fin]);
                } else {
                    $query->where('payment', $status)->whereBetween('annee', [$annee_debut, $annee_fin]);
                }
            })->get();

            if ($medecins->isNotEmpty()) { // Check if any medecins are found
                $List_PDF = [];

                foreach ($medecins as $medecin) {
                    $cotisations = Cotisation::where('id_medecin', $medecin->id)
                        ->where('annee', '>=', $annee_debut)
                        ->where('annee', '<=', $annee_fin)
                        ->get();

                    // Filter cotisations to keep only unpaid ones
                    $unpaidCotisations = $cotisations->filter(function ($cotisation) {
                        return $cotisation->payment === 0;
                    });

                    // Skip medecin if more than 4 unpaid cotisations in last 2 years
                    if ($unpaidCotisations->count() > $nbr_annee) {
                        continue;
                    }

                    // Create an array to store cotisations details for each medecin
                    $cotisationsData = [
                        'medecin_name' => $medecin->nom . ' ' . $medecin->prenom,
                        'cotisations' => [],
                    ];

                    foreach ($cotisations as $cotisation) {
                        // Push cotisations into the array
                        $cotisationsData['cotisations'][$cotisation->annee] = $cotisation->montant;
                    }

                    $List_PDF[] = $cotisationsData;
                }

                // Generate the HTML table
                $html = '<table>';
                $html .= '<thead>';
                $html .= '<tr style="background: #adb5bd;">';
                $html .= '<th>Num</th><th>Nom medecin</th>';

                // Add year headers
                for ($annee = $annee_debut; $annee <= $annee_fin; $annee++) {
                    $html .= '<th>' . $annee . '</th>';
                }

                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                $num = 0;

                // Add medecin data
                foreach ($List_PDF as $medecinData) {
                    $html .= '<tr>';
                    $html .= '<td>' . $num . '</td>';
                    $html .= '<td>' . $medecinData['medecin_name'] . '</td>';

                    // Loop through each year
                    for ($annee = $annee_debut; $annee <= $annee_fin; $annee++) {
                        // Check if a cotisation exists for this year
                        if (isset($medecinData['cotisations'][$annee])) {
                            $html .= '<td>' . $medecinData['cotisations'][$annee] . '</td>';
                        } else {
                            $html .= '<td></td>';
                        }
                    }

                    $num++;
                    $html .= '</tr>';
                }

                $html .= '</tbody>';
                $html .= '</table>';

                // Generate the PDF with dompdf and set landscape mode
                $pdf = PDF::loadHtml($html)->setPaper('letter', 'landscape');

                // Download the PDF
                return $pdf->download('journal-cotisations.pdf');
            } else {
                return redirect()->back()->with('error', 'No medecins found for the specified criteria.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid year range.');
        }
    }}
