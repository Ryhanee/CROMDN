<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Ville;
use App\Models\Lettre;
use App\Models\Cotisation;
use App\Models\Attestation;
use App\Models\Numerola;
use App\Models\Etat;
use Carbon\Carbon;
use PDF;
use I18N_Arabic_Glyphs;

use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

class DocumentController extends Controller
{
    public function showDocument($idMedecin)
    {
        $medecin = Medecin::whereId($idMedecin)->first();
        return view('showDocument', compact('medecin'));
    }

//fonctions des donnees postales
    public function showPostale($idMedecin)
    {
        $medecin = Medecin::whereId($idMedecin)->first();
        return view('showPostale', compact('medecin'));
    }



    public function generatePDFpostale($idMedecin)
    {
        ini_set('memory_limit','-1');
        ini_set('max_execution_time',0);
        set_time_limit(450);

        $medecin = Medecin::whereId($idMedecin)->first();

        $data = [
            'title' => 'Données Postales',
            'prenom' => $medecin->prenom,
            'nom' => $medecin->nom,
            'adresse' => $medecin->adresse,
            'code' => $medecin->ville->code_postal,
        ];

            $pdf = PDF::loadView('etiquettePostale', $data);

            // dd($pdf);
        return $pdf->download('cromdn.pdf');
    }

//fonctions des donnees postales
    public function showLettres($idMedecin)
    {
        $medecin = Medecin::whereId($idMedecin)->first();
        $lettres = Lettre::all();
        return view('showLettre', compact('medecin', 'lettres'));
    }

    public function generatePDFlettre()
    {
        $data = Input::all();
        $documentType = $data['document_type'];


        if (array_key_exists('print', $data)) {
            $num = Numerola::create([
                'id_lettre' => $data['lettre'],
                'id_medecin' => $data['idMedecin'],
            ]);
            $num = Numerola::all()->max('id');
        } else {
            $num = '';
        }

        $carbon = new Carbon();
        $date = $carbon->isoFormat('D MMMM YYYY');


        $medecin = Medecin::whereId($data['idMedecin'])->first();
        $lettre = Lettre::whereId($data['lettre'])->first()->text;
        $cotisations = Cotisation::where('id_medecin', $data['idMedecin'])->where('payment', 0)->get();
        $ville = $medecin->ville->libelle;
        //$code=$medecin->ville->code_postal;

        $non_paye = [];
        foreach ($cotisations as $cotisation) {
            array_push($non_paye, $cotisation->annee);
        }
        $montant = $cotisations->sum('montant');
        $tab = $medecin->toArray();

        if ($medecin->sexe == 1) {
            $lettre = str_replace("[epouse]", " ", $lettre);
            $lettre = str_replace("[confrere]", "Monsieur et cher confrère", $lettre);
        } else {
            $lettre = str_replace("[confrere]", "Msadame et chère consoeur", $lettre);
        }
        foreach ($tab as $key => $value) {
            if ($key != 'ville') {
                $lettre = str_replace("[" . $key . "]", $value, $lettre);
            } else {
                foreach ($value as $key1 => $value1) {
                    $lettre = str_replace("[" . $key1 . "]", $value1, $lettre);
                }
            }
        }

        $non_paye = implode(" - ", $non_paye);
        $lettre = str_replace("[non_paye]", $non_paye, $lettre);
        $lettre = str_replace("[montant]", $montant, $lettre);
        $lettre = str_replace("[date]", $date, $lettre);
        $lettre = str_replace("[num]", $num, $lettre);

        if ($documentType === 'word') {

            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            // dd($attestation);

            Html::addHtml($section, $lettre);
            $filename = 'cromdn.docx'; // Filename for saving

            try {
                $writer = IOFactory::createWriter($phpWord, 'Word2007');
                $writer->save(storage_path($filename)); // Save the file
            } catch (\Exception $e) {
                // Log or handle the error
                return response()->json(['error' => 'Error saving the Word document'], 500);
            }

            // VERIFIER SI LE FICHIER EXIST
            if (file_exists(storage_path($filename))) {
                return response()->download(storage_path($filename), 'cromdn.docx')->deleteFileAfterSend(true);
            } else {
                // Log or handle the error
                return response()->json(['error' => 'File not found'], 404);
            }
        } else {

            $pdf = PDF::loadHtml($lettre);
            return $pdf->stream('cromdn.pdf');
        }
    }

    public function showAttestation($idMedecin)
    {
        $medecin = Medecin::whereId($idMedecin)->first();
        $attestations = Attestation::all();
        return view('showAttestation', compact('medecin', 'attestations'));
    }


    /**
     * @throws Exception
     */
    public function generatePDFasttestation(Request $request)
    {
        $data = $request->all();
        $documentType = $request->input('document_type');
        //dd($documentType);
        if (array_key_exists('print', $data)) {
            $num = Numerola::create([
                'id_attestation' => 1,
                'id_medecin' => 2,
            ]);
            //$num=Numerola::all()->max('id');
        } else {
            $num = '';
        }

        $carbon = Carbon::now()->locale('fr_FR');
        if ($data['attestation'] < 13) {
            $date = $carbon->isoFormat('D MMMM YYYY');
        } else {
            $date = $carbon->isoFormat('D / MM / YYYY');
        }

        $annee = $carbon->isoFormat('YY');

        $medecin = Medecin::whereId($data['idMedecin'])->first();
        $ville = $medecin->ville->libelle;

        $date_insecrit = Etat::where('id_medecin', $data['idMedecin'])->where('id_type', 10)->first()->date;

        if ($documentType === 'word') {
            $attestation = Attestation::whereId($data['attestation'])->first()->text_word;
        } else {
            $attestation = Attestation::whereId($data['attestation'])->first()->text;

        }
        if ($data['attestation'] == 10) {
            $rdv = $data['rdv'];
            $attestation = str_replace("[rdv]", $rdv, $attestation);
        }

        $pres = $request->input('pres');
        $ref = $request->input('ref');

        if (preg_match('/[اأإء-ي]/ui', $pres)) {
            require_once("I18N/Arabic/Glyphs.php");
            $Arabic = new I18N_Arabic_Glyphs('Glyphs');
            $pres = $Arabic->utf8Glyphs($pres, 150);
            $pres = utf8_strrev($pres);
        }

        $tab = $medecin->toArray();

        if ($medecin->sexe == 1) {
            $attestation = str_replace("[epouse]", " ", $attestation);
            $attestation = str_replace("[confrere]", "Monsieur et cher confrère", $attestation);
        } else {
            $attestation = str_replace("[confrere]", "Madame et chère consoeur", $attestation);
        }

        foreach ($tab as $key => $value) {
            if ($key != 'ville') {
                $attestation = str_replace("[" . $key . "]", $value, $attestation);
            } else {
                foreach ($value as $key1 => $value1) {
                    $attestation = str_replace("[" . $key1 . "]", $value1, $attestation);
                }
            }
        }

        $attestation = str_replace("[date]", $date, $attestation);
        $attestation = str_replace("[annee]", $annee, $attestation);
        $attestation = str_replace("[num]", $ref, $attestation);
        $attestation = str_replace("[pres]", $pres, $attestation);
        $attestation = str_replace("[date_insecrit]", $date_insecrit, $attestation);

        if ($documentType === 'word') {

            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            // dd($attestation);

            Html::addHtml($section, $attestation);
            $filename = 'attestation.docx'; // Filename for saving

            try {
                $writer = IOFactory::createWriter($phpWord, 'Word2007');
                $writer->save(storage_path($filename)); // Save the file
            } catch (\Exception $e) {
                // Log or handle the error
                return response()->json(['error' => 'Error saving the Word document'], 500);
            }

            // VERIFIER SI LE FICHIER EXIST
            if (file_exists(storage_path($filename))) {
                return response()->download(storage_path($filename), 'attestation.docx')->deleteFileAfterSend(true);
            } else {
                // Log or handle the error
                return response()->json(['error' => 'File not found'], 404);
            }
        } else {
            $pdf = PDF::loadHtml($attestation);
            return $pdf->stream('attestation.pdf');
        }
    }

    public function manyLettre()
    {
        ini_set('memory_limit','-1');
        ini_set('max_execution_time',0);
        set_time_limit(450);
        $data = Input::all();

        $medecins = $data['medecins'];
        $documentType = $data['document_type'];

        if ($medecins) {
            $IdMedecins = explode(" ", $medecins);

            $carbon = new Carbon();
            $date = $carbon->isoFormat('D MMMM YYYY');

            $List_PDF = [];

            foreach ($IdMedecins as $medecinId) {
                $medecin = Medecin::whereId($medecinId)->first();

                $lettre = Lettre::whereId($data['lettre'])->first()->text;

                Numerola::create([
                    'id_lettre' => $data['lettre'],
                    'id_medecin' => $medecin->id,
                ]);
                $num = Numerola::all()->max('id');

                $cotisations = Cotisation::where('id_medecin', $medecin->id)->where('payment', 0)->get();
                $ville = $medecin->ville->libelle;

                $non_paye = [];
                foreach ($cotisations as $cotisation) {
                    array_push($non_paye, $cotisation->annee);
                }
                $montant = $cotisations->sum('montant');
                $tab = $medecin->toArray();

                if ($medecin->sexe == 1) {
                    $lettre = str_replace("[epouse]", " ", $lettre);
                    $lettre = str_replace("[confrere]", "Monsieur et cher confrère", $lettre);
                } else {
                    $lettre = str_replace("[confrere]", "Msadame et chère consoeur", $lettre);
                }

                foreach ($tab as $key => $value) {
                    if ($key != 'ville') {
                        $lettre = str_replace("[" . $key . "]", $value, $lettre);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $lettre = str_replace("[" . $key1 . "]", $value1, $lettre);
                        }
                    }
                }
                $non_paye = implode(" - ", $non_paye);
                $lettre = str_replace("[non_paye]", $non_paye, $lettre);
                $lettre = str_replace("[montant]", $montant, $lettre);
                $lettre = str_replace("[date]", $date, $lettre);
                $lettre = str_replace("[num]", $num, $lettre);

                array_push($List_PDF, $lettre);
            }
            if ($documentType === 'word') {
                $phpWord = new PhpWord();
                $section = $phpWord->addSection();
                // dd($attestation);

                Html::addHtml($section, $lettre);
                $filename = 'Lettre_Rappel.docx'; // Filename for saving

                try {
                    $writer = IOFactory::createWriter($phpWord, 'Word2007');
                    $writer->save(storage_path($filename)); // Save the file
                } catch (\Exception $e) {
                    // Log or handle the error
                    return response()->json(['error' => 'Error saving the Word document'], 500);
                }

                // VERIFIER SI LE FICHIER EXIST
                if (file_exists(storage_path($filename))) {
                    return response()->download(storage_path($filename), 'attestation.docx')->deleteFileAfterSend(true);
                } else {
                    // Log or handle the error
                    return response()->json(['error' => 'File not found'], 404);
                }
            } else {

                $list_lettres = implode(''
                    , $List_PDF);
                $pdf = PDF::loadHtml($list_lettres);

                return $pdf->download('Lettre_Rappel.pdf');
            }
        } else {
            return redirect()->back();
        }
    }

    public function manyPostale()
    {
        ini_set('memory_limit','-1');
        ini_set('max_execution_time',0);
        set_time_limit(450);

        $data = Input::all();
        $postales = [];

        $medecins = $data['medecins'];
        $IdMedecins = explode(" ", $medecins);

        foreach ($IdMedecins as $medecinId) {
            $data = Input::all();
            $medecin = Medecin::whereId($medecinId)->first();
            $data = [
                'prenom' => $medecin->prenom,
                'nom' => $medecin->nom,
                'adresse' => $medecin->adresse,
                'code' => $medecin->ville->code_postal,
            ];
            array_push($postales, $data);
        }
        $info = [
            'postales' => $postales,
        ];

        $pdf = PDF::loadView('manyEtiquette', $info);
        //$pdf->setPaper('A4', 'landscape'); // Set paper size and orientation

        $pdf->setOptions(['rotation' => 90]);

        //$pdf->getDomPDF()->getCanvas()->rotate(90, 100, 100); // Example rotation point (100, 100)

        // $v=implode(' ',$postales);
        // $pdf = PDF::loadHtml($v);
//return view('manyEtiquette',['postales' => $postales]);
        return $pdf->stream('cromdn.pdf');

    }


    public function generateWORDasttestation()
    {
        // Initialize PhpWord
        $phpWord = new PhpWord();

        // Add a section
        $section = $phpWord->addSection();

        $data = Input::all();

        if (array_key_exists('print', $data)) {
            $num = Numerola::create([
                'id_attestation' => 1,
                'id_medecin' => 2,
            ]);
        } else {
            $num = '';
        }

        $carbon = Carbon::now()->locale('fr_FR');
        if ($data['attestation'] < 13) {
            $date = $carbon->isoFormat('D MMMM YYYY');
        } else {
            $date = $carbon->isoFormat('D / MM / YYYY');
        }

        $annee = $carbon->isoFormat('YY');

        $medecin = Medecin::whereId($data['idMedecin'])->first();
        $ville = $medecin->ville->libelle;

        $date_insecrit = Etat::where('id_medecin', $data['idMedecin'])->where('id_type', 10)->first()->date;

        $attestation = Attestation::whereId($data['attestation'])->first()->text;

        if ($data['attestation'] == 10) {
            $rdv = $data['rdv'];
            $attestation = str_replace("[rdv]", $rdv, $attestation);
        }

        $tab = $medecin->toArray();

        if ($medecin->sexe == 1) {
            $attestation = str_replace("[epouse]", " ", $attestation);
            $attestation = str_replace("[confrere]", "Monsieur et cher confrère", $attestation);
        } else {
            $attestation = str_replace("[confrere]", "Madame et chère consoeur", $attestation);
        }

        // Replace placeholders with actual values
        foreach ($tab as $key => $value) {
            if ($key != 'ville') {
                $attestation = str_replace("[" . $key . "]", $value, $attestation);
            } else {
                foreach ($value as $key1 => $value1) {
                    $attestation = str_replace("[" . $key1 . "]", $value1, $attestation);
                }
            }
        }

        // Add the attestation content to the document
        $section->addText($attestation);

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

       return $objWriter->download(storage_path('Lettre_Rappel.docx'));
    }

}
