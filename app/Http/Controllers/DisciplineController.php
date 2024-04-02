<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Etat;
use App\Models\Type_etat;
use App\Models\Type_sanction;
use App\Models\Mode;
use App\Models\Discipline;
use Validator;

class DisciplineController extends Controller
{
    public function showDisciplines($idMedecin)
    {
        $sanctions=Type_sanction::All();   
        $medecin=Medecin::where('id',$idMedecin)->first();

        $disciplines=Discipline::where('id_medecin',$idMedecin)->orderBy('date','desc')->paginate(5);

        return view('listDisciplines', compact('disciplines','medecin','sanctions'));
    }

    public function createDiscipline()
    {

        $data=Input::all();

        $Medecin=Medecin::whereId($data['medecin'])->first();

        Discipline::create([
            'reference' => $data['reference'],
            'id_medecin'=>$data['medecin'],
            'date'=> $data['date'],
            'id_sanction' => $data['id_sanction'],
            'observation' => $data['observation'],
        ]);
        return redirect()->back()->withErrors(['L\'opération a été effectuée avec succès']);
    }

    public function updateDiscipline($id)
    {
        $data=Input::all();
        Discipline::whereId($id)->update([
            'reference' => $data['reference'],
            'date'=> $data['date'],
            'id_sanction' => $data['id_sanction'],
            'observation' => $data['observation'],
            'recours' => $data['recours'],
        ]);
        return back()->withErrors(['L\'opération a été effectuée avec succès']);

    }
    public function deleteDiscipline($id)
    {   
        $discipline=Discipline::whereId($id)->first();       
        $discipline->delete();
        return redirect()->back()->withErrors(['L\'opération a été effectuée avec succès']); 
    }    
}
