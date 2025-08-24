@extends('layouts.layout1')
@section('title', 'Liste des medecins delete')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 total">
            <h3>
                Liste des Médecins Dentistes retirés <span class="badge badge-light">{{ $medecins->total() }}</span>
            </h3>
        </div>
    </div>

    <!-- Liste  des medecins --->

    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-12 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N° Inscription</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Restaurer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $medecin)
                <tr>
                    <th >{{ $medecin->id }}</th>
                    <td>{{ $medecin->nom }} </td>
                    <td>{{ $medecin->prenom }}</td>
                    <td><a href="{{ route('restoreDoctorsDelete',$medecin->id) }}" ><i class="fa fa-window-restore" ></i></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $medecins->links() }}
    </div>
</div>

@endsection
