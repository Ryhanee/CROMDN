<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Plainte;
use App\Models\Motif;
use App\Models\Convocation;
use App\Models\Type_sanction;
use Validator;

class PlainteController extends Controller
{
   public function showPlaintes($idMedecin)
   {
      $medecin=Medecin::whereId($idMedecin)->first();
      $plaintes=Plainte::where('id_medecin',$idMedecin)->orderBy('date_plainte','desc')->paginate(5);

      return view('listPlaintes', compact('plaintes','medecin'));
   }

   public function showCreatePlainte($IdMedecin)
   {
      $medecin=Medecin::whereId($IdMedecin)->first();
      $motifs=Motif::All();
      return view('formCreatePlainte',compact('motifs','medecin'));
   }

   public function createPlainte($IdMedecin)
   {
      $data=Input::all();
      $medecin=Medecin::whereId($IdMedecin)->first();


      if($medecin)
      {
         if($data['date_plainte']<$data['date_decision'])
         {
            if($data['id_motif']== 1 || $data['id_motif']== 4)
            {
               $rulesPatient = [
                  'nom_plaignant' => 'required|string',
                  'prenom_plaignant' => 'required|string', 
                  'tel_plaignant' => 'required', 

               ];

               $messagesPatient = [

                  'nom_plaignant.required' => 'le nom plaignant est obligatoire',
                  'prenom_plaignant.required' => 'le prenom plaignant est obligatoire',
                  'tel_plaignant.required' => 'le telephone plaignant est obligatoire',

               ];

               $validation = Validator::make($data, $rulesPatient, $messagesPatient);

               if ($validation->fails()) 
               {
                  return redirect(route('showCreatePlainte',$IdMedecin))->withErrors($validation->errors());
               }
               else
               {    
                  Plainte::create([
                     'id_medecin'=> $IdMedecin,
                     'date_plainte' => $data['date_plainte'],
                     'commentaire' => $data['commentaire'],
                     'decision' => $data['decision'],
                     'date_decision' => $data['date_decision'],
                     'id_motif' => $data['id_motif'],
                     'nom_plaignant' => $data['nom_plaignant'],
                     'prenom_plaignant' => $data['prenom_plaignant'],
                     'tel_plaignant' => $data['tel_plaignant'],
                  ]);
               }
            }

            elseif ($data['id_motif']==3)
            {
               $rulesMedecin = [
                  'id_medecin_plaignant' => 'required',

               ];

               $messagesMedecin = [

                  'id_medecin_plaignant.required' => 'le numero de medecin plaignant est obligatoire',           
               ];

               $validation = Validator::make($data, $rulesMedecin, $messagesMedecin);

               if ($validation->fails()) 
               {
                  return redirect(route('showCreatePlainte',$IdMedecin))->withErrors($validation->errors());
               }
               else
               {    
                  Plainte::create([
                     'id_medecin'=> $IdMedecin,
                     'date_plainte' => $data['date_plainte'],
                     'commentaire' => $data['commentaire'],
                     'decision' => $data['decision'],
                     'date_decision' => $data['date_decision'],
                     'id_motif' => $data['id_motif'],
                     'id_medecin_plaignant' => $data['id_medecin_plaignant'],

                  ]);
               }
            }	
            else
            {
               $Plainte=Plainte::create([

                  'id_medecin'=> $IdMedecin,
                  'date_plainte' => $data['date_plainte'],
                  'commentaire' => $data['commentaire'],
                  'decision' => $data['decision'],
                  'date_decision' => $data['date_decision'],
                  'id_motif' => $data['id_motif'],

               ]);
            } 
            return redirect(route('showPlaintes',$medecin))->withErrors(['L\'opération a été effectuée avec succès']); 
         }
         else
         {
            return back()->withErrors('La date de la décision doit être ultérieure à la date de plainte');
         }     
      }

      else
      {
         return redirect(route('showIndex'))->withErrors(['Le medecin inexistant']);
      }    
   }

   public function deletePlainte($id)
   {
      $plainte=Plainte::whereId($id)->first();
      $medecin=Medecin::whereId($plainte->id_medecin)->first();
      $plainte->delete();

      return redirect(route('showPlaintes',$medecin))->withErrors(['L\'opération a été effectuée avec succès']);
   }

   public function showUpdatePlainte($idPlainte)
   {
      $motifs=Motif::All();
      $plainte=Plainte::whereId($idPlainte)->first();
      $medecin=Medecin::whereId($plainte->id_medecin)->first();
      return view('formUpdatePlainte',compact('motifs','plainte','medecin'));
   }   
   public function updatePlainte($idPlainte)
   {
      $data=Input::all();
      $plainte=Plainte::whereId($idPlainte)->first();
      $IdMedecin=Medecin::whereId($plainte->id_medecin)->first();


      $convocationsMinDate=Convocation::where('id_plainte',$idPlainte)->min('date');

      if($convocationsMinDate!=Null && $convocationsMinDate < $data['date_plainte'] )
      {
         return redirect()->back()->withErrors(['La date du plainte doit être antérieur à les dates des convocations']);
      }
      else
      {
         if($data['id_motif']==1 || $data['id_motif']==4)
         {
            Plainte::whereId($idPlainte)->update([
               'date_plainte' => $data['date_plainte'],
               'commentaire' => $data['commentaire'],
               'decision' => $data['decision'],
               'date_decision' => $data['date_decision'],
               'id_motif' => $data['id_motif'],
               'nom_plaignant' => $data['nom_plaignant'],
               'prenom_plaignant' => $data['prenom_plaignant'],
               'tel_plaignant' => $data['tel_plaignant'],
               'id_medecin_plaignant' =>null,
            ]);
         }
         elseif ($data['id_motif']==3)
         {
            Plainte::whereId($idPlainte)->update([
               'date_plainte' => $data['date_plainte'],
               'commentaire' => $data['commentaire'],
               'decision' => $data['decision'],
               'date_decision' => $data['date_decision'],
               'id_motif' => $data['id_motif'],
               'id_medecin_plaignant' => $data['id_medecin_plaignant'],
               'nom_plaignant' => Null,
               'prenom_plaignant' => Null,
               'tel_plaignant' => null,

            ]);
         }    
         else
         {
            Plainte::whereId($idPlainte)->update([
               'date_plainte' => $data['date_plainte'],
               'commentaire' => $data['commentaire'],
               'decision' => $data['decision'],
               'date_decision' => $data['date_decision'],
               'id_motif' => $data['id_motif'],
               'nom_plaignant' => Null,
               'prenom_plaignant' => Null,
               'tel_plaignant' => null,
               'id_medecin_plaignant' =>null,
            ]);
         }
      }
      return redirect(route('showPlaintes',$IdMedecin))->withErrors(['L\'opération a été effectuée avec succès']);
   }

   public function showConvocations($idPlainte)
   {
      // $medecin=Medecin::with('plainte')->when($idPlainte,function ($query) use ($idPlainte) {
      //    $query->whereId($idPlainte);
      // })->first();
      $plainte=Plainte::whereId($idPlainte)->first();
      $medecin=Medecin::whereId($plainte->id_medecin)->first();

      $convocations=Convocation::where('id_plainte',$idPlainte)->orderBy('date','desc')
      ->paginate(5);

      return view('listConvocations', compact('convocations','medecin','plainte'));
   }

   public function createConvocation()
   {
      $data=Input::all();

      $plainte=Plainte::whereId($data['idPlainte'])->first();

      if($plainte->date_plainte < $data['date'])
      {
         $c=Convocation::create([
            'id_plainte' => $data['idPlainte'],
            'date' => $data['date'],
            'observation' => $data['observation'],
         ]);

         return redirect()->back()->withErrors(['L\'operation a été effectué  avec succès']);
         // return redirect(route('showConvocations',$data['idPlainte']))->withErrors(['L\'operation a été effectué  avec succès']);
      }
      else
      {
         return redirect()->back()->withErrors(['La date de la convocation doit être postérieure à la date de la plainte']);
         // return redirect(route('showConvocations',$data['idPlainte']))->withErrors(['La date du convocation doit être postérieur la date de plainte']);
      }
   }

   public function deleteConvocation($id)
   {
      Convocation::whereId($id)->delete();

      return redirect()->back()->withErrors(['L\'operation a été effectué  avec succès']);
   }
   
   public function updateConvocation($id)
   {
      $data=Input::all();
      $idP=Convocation::whereId($id)->first()->id_plainte;
      $plainte=Plainte::whereId($idP)->first();

      if($plainte->date_plainte < $data['date'])
      {
         Convocation::whereId($id)->update([
            'date' => $data['date'],
            'observation' => $data['observation'],
         ]);
         return redirect(route('showConvocations',$idP))->withErrors(['L\'operation a été effectué  avec succès']);
      }
      else
      {
         return redirect(route('showConvocations',$idP))->withErrors(['La date de convocation est postérieur à la date de la plainte']);
      }
   }
}