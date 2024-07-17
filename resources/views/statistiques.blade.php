@extends('layouts.layout1')
@section('title', 'Statistiques')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 total">
            <h3>
            Statistiques des Médecins Dentistes Par Etat<span class="badge badge-light"></span>
            </h3>
        </div>
    </div>

    <!-- Liste  des medecins --->

    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-12 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Etat</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stat as $statistic)
                <tr>
                    <th >{{ $statistic['libelle'] }}</th>
                    <td>{{ $statistic['count'] }} </td>
                 </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection