<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Medecin;
use App\Models\Position;
use Mail;

class ContactController extends Controller
{
	//envoi SMS individuel

	public function showFormSMS($idMedecin)
	{
		$medecin=Medecin::where('id',$idMedecin)->first();
		return view('formSMS', compact('medecin'));
	}

	public function sendMessage(Request $request)
	{
		$IdMedecin=$request->input('IdMedecin');
		$phone ='216'.$request->input('phone_number');
		$phone_number =intval($phone);

		$message = $request->input('message');

		$sending=$this->initiateSmsActivation($phone_number, $message);
		if ($sending) 
		{
			return redirect(route('showMedecin',$IdMedecin))->withErrors(['L\'opération a été effectuée avec succès']);
		}
		return redirect(route('showMedecin',$IdMedecin))->withErrors('Le message n\'a pas été envoyé');
	} 


	public function initiateSmsActivation($phone_number, $msg)
	{
		$basic  = new \Nexmo\Client\Credentials\Basic('f64ed0b3', '7pEb8NK7iSzS9a5I');
		$client = new \Nexmo\Client($basic);

		$message = $client->message()->send([
			'to' => $phone_number,
			'from' => 'Cromdn',
			'text' => $msg
		]);
		return $message;
	}

	//envoi SMS mutiple
    public function formManySMS()
    {
        $data=Input::all();
        $medecinsId=$data['medecins'];
        return view('formCreateManySMS',compact('medecinsId'));
    }
    public function sendMessages(Request $request)
    {
      $medecins=$request->input('medecins');
      $IdMedecins=explode(" ", $medecins);

      $smsMedecins = Medecin::whereIn('id',$IdMedecins)->where('gsm','!=',"")->get();

      $allMedecins = Medecin::whereIn('id',$IdMedecins);
      $medecinsGet = $allMedecins->get();
      $medecinsArry=$allMedecins->paginate(8);
      $locations = Position::whereIn('id_medecin',$IdMedecins)->get();
      
        foreach ($smsMedecins as $medecinId)
       {
       $medecin=Medecin::whereId($medecinId)->first();
        $phone ='216'.($medecin->gsm);
        $phone_number =intval($phone);
        $message = $request->input('message');
        $sending=$this->initiateSmsActivation($phone_number, $message);
        if ($sending == null)
        {
            return redirect()->back()->withErrors(['Désolé! Veuillez réessayer plus tard']);
        }
    }
        return view('listMedecins',['medecins'=>$medecinsArry , 'locations'=>$locations])->withErrors('Les messages ont été envoyés');
  }

	//envoi email individuel

	public function formMail($id)
	{
	      $medecin=Medecin::whereId($id)->first();
	     return view('formCreateMail',compact('medecin'));
	}

	public function sendEmail($id)
   	{
       $data=Input::all();
       $data['email']=$data['mail'];
       $medecin=Medecin::whereId($id)->first();

       Mail::send('email', $data, function($message) use ($medecin) {
           $data=Input::all();
           $message->to($medecin->email, $medecin->nom )
                   ->subject($data['subject']);
       });
       if (Mail::failures()) {
          return redirect(route('showMedecin',$id))->withErrors('Désolé! Veuillez réessayer plus tard');
        }
        else
        {
          return redirect(route('showMedecin',$id))->withErrors('L\'Email a été envoyé');
        }
  	}

	//envoi email mutiple

	public function formManyEmail()
	{
		$data=Input::all();
		$medecinsId=$data['medecins'];
    $IdMedecins=explode(" ", $medecinsId);
    //dd($IdMedecins);
    $medecinsArry=Medecin::whereIn('id',$IdMedecins)->paginate(8);
    //dd($medecinsArry);
		return view('formCreateManyMails',compact('medecinsId','medecinsArry'));
	}

	public function sendManyEmail()
	{
		$data=Input::all();
    $content = ['email'=> $data['mail'] ];
    $medecins=$data['medecins'];
    $IdMedecins=explode(" ", $medecins);

    $emailMedecins = Medecin::whereIn('id',$IdMedecins)->where('email','!=',"")->get();


    $allMedecins = Medecin::whereIn('id',$IdMedecins);
    $medecinsGet = $allMedecins->get();
    $medecinsArry=$allMedecins->paginate(8);
    $locations = Position::whereIn('id_medecin',$IdMedecins)->get();

    foreach ($emailMedecins as $medecin)
      {
        if (filter_var($medecin->email, FILTER_VALIDATE_EMAIL)) {

          Mail::send('email', $content, function($message) use ($medecin) 
          {             
            $data=Input::all();
            $message->to($medecin->email, $medecin->nom )->subject($data['subject']);
          });
              
          if(count(Mail::failures()) > 0 )
          {
          return back()->withErrors('Désolé! Veuillez réessayer plus tard');
          } 

        }           
     	}

      return view('listMedecins',['medecins'=>$medecinsArry, 'locations'=>$locations,'medecinsGet' => $medecinsGet ])->withErrors('Les emails ont été envoyés');
	}
  
  //button retour du sms et email multiple
  public function listMedecins($mds)
  {
    $IdMedecins=explode(" ", $mds);
    $medecins=Medecin::whereIn('id',$IdMedecins)->paginate(8);
    $locations = Position::whereIn('id_medecin',$IdMedecins)->get();
    return view('listMedecins',['medecins'=>$medecins , 'locations'=>$locations]);
  }
}