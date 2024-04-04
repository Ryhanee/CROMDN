@extends('layouts.layout1')
@section('title', 'Liste des medecins')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 total">
            <h3>
                Liste des Médecins Dentistes <span class="badge badge-light">{{ count($medecins) }}</span>
            </h3>

        </div>

    </div>

    <!-- Liste  des medecins --->

    <div class="row justify-content-between  entete_medecin">
        <div class="col-md-12">
            <div class="float-left btn-list">
                <form action="{{ route('manyLettre') }}" method="post" target="_blank">
                @csrf
                    <input type="hidden" name="medecins" value="{{($medecins->implode('id', ', '))}}">
                    <input type="hidden" name="lettre" value="1">
                    <button type="submit"  class="btn btn-warning" >
                     Lettre Rappel 1 <i class="fas fa-envelope"></i>
                    </button>
                </form>
            </div>

            <div class="float-left btn-list">
                <form action="{{ route('manyLettre') }}" method="post" target="_blank">
                @csrf
                    <input type="hidden" name="medecins" value="{{($medecins->implode('id', ', '))}}">
                    <input type="hidden" name="lettre" value="2">
                    <button type="submit"  class="btn btn-info" >
                    Lettre Rappel 2 <i class="fas fa-envelope"></i>
                    </button>
                </form>
            </div>


            <div class="float-left btn-list">
                <form action="{{ route('manyPostale') }}" method="post" target="_blank">
                @csrf
                    <input type="hidden" name="medecins" value="{{($medecins->implode('id', ', '))}}">
                    <button type="submit"  class="btn btn-info btn-document" >
                    Informations Postales <i class="fas fa-address-card"></i>
                    </button>
                </form>
            </div>

            <div class="float-left btn-list">
                <form action="{{ route('exportCotisations') }}" method="post" target="_blank">
                    @csrf
                    <input type="hidden" name="medecins" value="{{($medecins->implode('id', ', '))}}">
                    <input type="hidden" name="anne_debut" value="{{$Anne_in}}">
                    <input type="hidden" name="anne_fin" value="{{$Anne_out}}">

                    <button type="submit"  class="btn btn-info" >
                        Exporter les cotisations <i class="fas fa-envelope"></i>
                    </button>
                </form>
            </div>

    </div>
</div>

    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-12 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N° Inscription</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Profil</th>


                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $medecin)
                <tr>
                    <th >{{ $medecin->id }}</th>
                    <td>{{ $medecin->nom }} </td>
                    <td>{{ $medecin->prenom }}</td>
                    <td ><a href="{{ route('showMedecin',$medecin->id) }}">
                        <i class="fas fa-user-circle  fa-2x"></i>
                    </a>
                    </td>

                </tr>

                @endforeach
                </tbody>
            </table>
            {{-- $medecins->render() --}}

        </div>

    </div>
@endsection
