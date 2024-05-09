<!DOCTYPE html>
<html>
<head>
    <title>Données Postales</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/maincss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <style type="text/css">
        body {
            margin-top: 30px;
            margin-left: 0; /* Supprimez la marge gauche par défaut */
            margin-right: 0; /* Supprimez la marge droite par défaut */
            padding: 0; /* Supprimez le remplissage par défaut */
        }

        #container {
            width: 100%; /* Document en pleine largeur */
            overflow: auto;
        }

        .ligne {
            clear: both;
            margin-bottom: 20px; /* Ajoutez un espacement entre les lignes */
        }

        .bloc {
            width: 25%;
            float: left;
            box-sizing: border-box; /* Inclure les bordures et les marges dans la largeur */
            padding: 10px;
        }

        .etiquette {
            border: 1px solid black;
            border-radius: 5px;
            padding: 5px;
            margin-bottom: 10px;
            width: 100%; /* Chaque étiquette prend 100% de la largeur du bloc */
        }

        h5 {
            margin: 0; /* Réinitialiser la marge */
        }
    </style>
</head>
<body>
<div id="container">
    @foreach($postales as $index => $postale)
    @if($index % 4 == 0)
    <div class="ligne">
        @endif
        <div class="bloc">
            <div class="etiquette">
                <h5>{{ $postale['prenom'] }} {{ $postale['nom'] }}</h5>
                <h5>{{ $postale['adresse'] }}</h5>
                <h5>{{ $postale['code'] }}</h5>
            </div>
        </div>
        @if(($index + 1) % 4 == 0 || $loop->last)
    </div>
    @endif
    @endforeach
</div>
</body>
</html>
