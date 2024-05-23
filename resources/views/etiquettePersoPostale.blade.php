<!DOCTYPE html>
<html>
<head>
    <title>Données Postales</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/maincss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <style type="text/css">
        body {
            /*margin-top: 30px;*/
            margin-left: 0 !important; /* Supprimez la marge gauche par défaut */
            margin-right: 0 !important; /* Supprimez la marge droite par défaut */
            padding: 0; /* Supprimez le remplissage par défaut */
            margin-bottom:0 !important;
        }

        #container {
            width: 100%; /* Document en pleine largeur */
            overflow: auto;
        }

        .ligne {
            clear: both;
            /*margin-bottom: 20px; !* Ajoutez un espacement entre les lignes *!*/
        }

        .bloc {
            width: 33.1%;
            float: left;
            box-sizing: border-box; /* Inclure les bordures et les marges dans la largeur */
            padding: 1px;
        }

        .etiquette {
            border: 1px solid black;
            border-radius: 5px;
            padding: 2px;
            margin-bottom: 1px;
            width: 100%; /* Chaque étiquette prend 100% de la largeur du bloc */
            height: 132px;
        }

        p {
            margin: 0;
            font-size:11px;
            font-weight: bold;/* Réinitialiser la marge */
        }
    </style>
</head>
<body>
<div id="container">
    @foreach($postales as $index => $postale)
    @if($index % 3 == 0)
    <div class="ligne">
        @endif
        <div class="bloc">
            <div class="etiquette" >
                <p style="text-align: left; margin-bottom: 5px;">{{ $postale['prenom'] }} {{ $postale['nom'] }}</p>
                <p style="text-align: center;margin-bottom: 5px;">{{ $postale['adresse'] }}</p>
                <p style="text-align: right;">{{ $postale['code'] }}</p>
            </div>
        </div>
        @if(($index + 1) % 4 == 0 || $loop->last)
    </div>
    @endif
    @endforeach
</div>
</body>
</html>
