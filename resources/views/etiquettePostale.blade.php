<!DOCTYPE html>
<html>
<head>
  <title>Données Postales</title>
          <link rel="stylesheet" type="text/css" href="{{asset('css/maincss.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">

        <style type="text/css">
          #title{
            margin: 30px;
          }
          #postale
          {
            margin: auto;  
          }
        </style>
</head>
<body>
  <h1 id="title"> {{ $title }}</h1>
  
  <div class="row" >   
   
      <div id="postale" class="title col-md-5">
          <h4 id="pseudo"> {{ $prenom }} {{ $nom}}</h4>
          <h5 id="adress"> {{ $adresse }}</h5>  
          <h4 id="code"> {{ $code }} </h4> 
      </div>

  </div>
  
</body>
</html>
