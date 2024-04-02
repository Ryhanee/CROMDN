   @extends('layouts.layout1')
   @section('title', 'reset password')
   @section('content')
        <div class="container">
            <div class="row">
                 <div class="title col-md-12">
            <h2>Reset password</h2> 
        </div>
                
            </div>

<!-- Formulaire de Reset password   --->

    <form class="row" action="{{ route('resetPassword',Auth::user()->id) }}" method="post">
    @csrf
        <div class="col-md-12 lot-center1">

          <div class="form-group row justify-content-center">

            <label for="password" class="col-form-label text-center">Nouveau password <span class="obligatoire"> *</span></label>
            <div class="col-sm-4">
              <input type="password" id="password" name="password" class="form-control">
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <label for="confirm_password" class="col-form-label text-center">Confirmer password <span class="obligatoire"> *</span></label>
            <div class="col-sm-4">
              <input type="password" id="confirm_password" name="confirm_password" class="form-control">
            </div>
          </div>
          
          <div id="info_password" class="col-md-4 info-pass">
          <p>Votre mot de passe doit contenir :
            <br>- Au minimum 8 caractères.
            <br>- Au moins 1 majuscule.
            <br>- Au moins 1 minuscule.
            <br>- Au moins chiffre.
          </p>       
      </div>
        
    </div>


            <div class="col-md-12 submit-center">

             <button type="submit" class="btn btn-primary btn-rechercher">Reset</button>
             <a href="{{route('showUser',Auth::user()->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
            </div>
        </form> 

    <!-- FIN de formulaire   --->
    </div>

    <script src="{{asset('js/password.anim.js') }}"></script>
    <script src="{{ asset('js/password.js')}}"></script>
    @endsection