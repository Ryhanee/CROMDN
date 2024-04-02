<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Ville;
use App\Models\Delegation;
use App\Models\Gouvernorat;
use App\Models\Type_etat;
use App\Models\Exercice;
use App\Models\Specialite;
use App\Models\Diplome;
use App\Models\Mode;
use App\Models\Type_mode_exercice;
use Validator;
use Str;
use Auth;
use Session;

class UserController extends Controller
{
   public function showIndex()
   {
      $villes = Ville::orderBy('libelle', 'asc')->get();
      $delegations = Delegation::orderBy('libelle', 'asc')->get();
      $gouvernorats = Gouvernorat::orderBy('libelle', 'asc')->get();
      $type_etats = Type_etat::orderBy('libelle', 'asc')->get();
      $exercices = Exercice::orderBy('libelle', 'asc')->get();
      $specialites = Specialite::orderBy('libelle', 'asc')->get();
      $diplomes = Diplome::orderBy('libelle', 'asc')->get();
      $modes = Mode::orderBy('libelle', 'asc')->get();//mode exercice
      $type_exercices = Type_mode_exercice::orderBy('libelle', 'asc')->get();


      return view('index', compact('villes','delegations','gouvernorats','type_etats','exercices','specialites','diplomes','modes','type_exercices'));
   }
   public function showParametre()
   {
      return view('showParametre');
   }

   public function showUsers()
   {
      $users = User::where('id_role','2')->paginate(5);
      return view('listAdmins', ['users' => $users]);
   }

   public function showUser($id)
   {

      if($id!=Auth::user()->id && Auth::user()->id_role!=1)
      {
         return redirect(route('logout'));
      }

      $user = User::whereId($id)->first();
      if($user)
      {
         return view('user', ['user' => $user]);
      }
      else
      {
         return redirect(route('showUsers'))->withErrors('L\'admin est Inexistant');
      }

   }

   public function showCreateUser()
   {
      return view('formCreateUser');
   }

   public function createUser()
   {
      $data=Input::all();
      $user=User::where('email',$data['email'])->first();
      if($user == null){
         $rules = [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|string|email|max:55|unique:users',
            'password' => 'required|string|min:8|
            regex:/[a-z]/|
            regex:/[A-Z]/|
            regex:/[0-9]/|'
         ];
         $messages = [
            'nom.required' => 'Votre nom est obligatoire',
//'nom.max' => 'le texte de nom ne doit pas contenir plus de 55 caractères',
            'prenom.required' => 'Votre prenom est obligatoire',
            'email.required' => 'le champ E-mail est obligatoire',
            'email.email' => 'le champ E-mail doit etre une adresse valide',
            'password.required' => 'Votre nom est obligatoire',
            'password.min' => 'Votre password doit contenir 8 caractères',
            'password.regex' => 'Votre password doit contenir des majuscules, des minuscules et des chiffres'
         ];
         $validation = Validator::make($data, $rules, $messages);
         if ($validation->fails())
         {
            return redirect()->back()->withErrors($validation->errors());
         }
         else
         {
            User::create([
               'nom' => $data['nom'],
               'prenom' => $data['prenom'],
               'id_role' => '2',
               'email' => $data['email'],
               'password' => Hash::make($data['password']),
               'remember_token' => Str::random(60),
            ]);
            return redirect(route('showUsers'))->withErrors(['L\'operation a été effectué  avec succès']);
         }
      }
      else
      {
         return redirect()->back()->withInput()->withErrors(['email'=>'L\'adresse mail existe déja']);
      }
   }



   public function showUpdateUser($id)
   {
      $user = User::whereId($id)->first();
      return view('formUpdateUser', ['user' => $user]);
   }

   public function updateUser($id)
   {
      $data=Input::all();
      $user=User::where('email',$data['email'])->first();
      if($user == null || $user->id == $id){
         if($data['password'] != null)
         {
            $rules = [
               'nom' => 'required|string',
               'prenom' => 'required|string',
               'email' => 'required|string|email|max:55',
               'password' => 'required|string|min:8|
               regex:/[a-z]/|
               regex:/[A-Z]/|
               regex:/[0-9]/|'
            ];
            $messages = [
               'nom.required' => 'Votre nom est obligatoire',
               'prenom.required' => 'Votre prenom est obligatoire',
               'email.required' => 'le champ E-mail est obligatoire',
               'email.email' => 'le champ E-mail doit etre une adresse valide',
               'password.required' => 'Votre nom est obligatoire',
               'password.min' => 'Votre password doit contenir 8 caractères',
               'password.regex' => 'Votre password doit contenir des majuscules, des minuscules et des chiffres'
            ];
         }
         else
         {
            $rules = [
               'nom' => 'required|string',
               'prenom' => 'required|string',
               'email' => 'required|string|email|max:55',
            ];
            $messages = [
               'nom.required' => 'Votre nom est obligatoire',
               'prenom.required' => 'Votre prenom est obligatoire',
               'email.required' => 'le champ E-mail est obligatoire',
               'email.email' => 'le champ E-mail doit etre une adresse valide',
            ];
         }
         $validation = Validator::make($data, $rules, $messages);
         if ($validation->fails())
         {
            return redirect()->back()->withErrors($validation->errors());
         }
         else
         {
            if($data['password'] != null)
            {
               User::whereId($id)->update([
                  'nom' => $data['nom'],
                  'prenom' => $data['prenom'],
                  'email' => $data['email'],
                  'password' => Hash::make($data['password']),
               ]);
            }
            else
            {
               User::whereId($id)->update([
                  'nom' => $data['nom'],
                  'prenom' => $data['prenom'],
                  'email' => $data['email'],
               ]);
            }
            return redirect(route('showUsers'))->withErrors(['L\'operation a été effectué  avec succès']);
         }
      }
      else
      {
         return redirect()->back()->withErrors(['L\'adresse mail existe déja']);
      }
   }

   public function deleteUser($id)
   {
      User::whereId($id)->delete();
      return back()->withErrors(['L\'operation a été effectué  avec succès']);
   }

   public function showResetPassword()
   {
      return view('resetPassword');
   }

   public function resetPassword($id)
   {
      $data=Input::all();
      $rules = [
         'password' => 'required|string|min:8|
         regex:/[a-z]/|
         regex:/[A-Z]/|
         regex:/[0-9]/|'
      ];
      $messages = [
         'password.required' => 'Votre nom est obligatoire',
         'password.min' => 'Votre password doit contenir 8 caractères',
         'password.regex' => 'Votre password doit contenir des majuscules, des minuscules et des chiffres'
      ];
      $validation = Validator::make($data, $rules, $messages);
      if ($validation->fails())
      {
         return redirect()->back()->withErrors($validation->errors());
      }
      else
      {
         User::whereId($id)->update([
            'password' =>Hash::make($data['password']),
         ]);
         return redirect(route('showUser',$id))->withErrors(['L\'operation a été effectué  avec succès']);
      }
   }

   public function showLogin()
   {
      if(Auth::user())
      {
         return view('welcome');
      }
      else
      {
         return view('login');
      }
   }

   public function handleLogin()
   {
      $data=Input::all();

      $credentials = [
         'email' => $data['email'],
         'password' => $data['password'],
      ];

      if (Auth::attempt($credentials)) //verification login et mot de pass
      {
         Auth::user(); // connexion
         return redirect(route('showIndex'));
         //return view('index');
      }
      else
      {
         return view('login')->withErrors(['Verifié l\'email et le mot de pass']); ;
      }
   }

   public function handleLogout()
   {
      Auth::logout(); // deconnexion
      return redirect(route('welcome'));
   }
}
