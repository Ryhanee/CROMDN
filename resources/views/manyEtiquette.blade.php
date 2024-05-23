<!DOCTYPE html>
<html>
<head>
   <title>Données Postales</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/maincss.css') }}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css') }}">
   <style type="text/css">

      body
      {
         margin-top: 30px;

      }
   #container
   {
      width: 90%;
      margin: auto;
   }
      #postal
      {
         border-style: solid;
         width: 90%;
         height: 150px;
         border-radius: 5px;
         padding: 5px;
         margin:6px auto;
      }
      #adres
      {
         text-align: center;
         margin: 5px;
      }
      #pseud
      {
         text-align: left;
      }
      #code
      {
         text-align: right;
      }
      #postal:nth-of-type(10n)
      {
         page-break-after: always;
      }
   </style>
</head>
<body>
   <div id="container">
      @foreach($postales as $postale)
       <div style="height: 700px;transform: rotate(90deg) translateY(450px);" >

       <div  id="postal">
                  <h5 id="pseud">  {{ $postale['prenom'] }} {{ $postale['nom'] }} </h5>
                  <h5 id="adres">  {{ $postale['adresse'] }}   </h5>
                  <h5 id="code">    {{ $postale['code'] }}  </h5>
             </div>
         </div>
      @endforeach
   </div>
</body>
</html>
