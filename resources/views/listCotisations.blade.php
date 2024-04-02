@extends('layouts.layout2')
@section('title', 'Cotisations')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 total">
            <h3>
                Liste des Cotisations <span class="badge badge-light">{{ $cotisations->total() }}</span>
            </h3>
        </div>
    </div>

    {{-- liste des cotisations--}}

    <div class="row table-responsive-md justify-content-center">
        <form class="row col-md-12 " action="{{ route('updateCotisations') }}" method="post">
            @csrf
            <div class="form-group row col-md-12 justify-content-center">
                <label  for="anne_in" class=" col-form-label">Derniére année de cotisation :</label>
                <div class="col-sm-4">


                   <select id="annee" name="annee" class="form-control">
                            @foreach($allCotisation as $cotisation)
                                @if($cotisation->annee == $lastYear)
                                    <option value="{{ $cotisation->annee }}" selected>{{ $cotisation->annee }}</option>
                                @else
                                    <option value="{{ $cotisation->annee }}" >{{ $cotisation->annee }}</option>
                                @endif
                            @endforeach
                   </select>
                   @if(!$lastYear)
                   <p style="color:brown;"><i class="fas fa-exclamation-circle"></i> Tous les cotisations ne sont pas payés</p>
                    @endif
                </div>
                <input type="hidden" name="medecin" value="{{$medecin->id}}">

            <div class="col-md-12 submit-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

        </form>
    </div>
            <table class="table table-hover table-striped col-md-12 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Année</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Statut</th>

                    </tr>
                </thead>
                <tbody>



                    @foreach($cotisations as $cotisation)
                    <tr>
                        <td> {{ $cotisation->annee }}   </td>
                        <td> {{ $cotisation->montant }} </td>
                        <td {{ $cotisation->payment == 1 ? 'class= btn-outline-success  ':'class= btn-outline-danger '}}> {{ transformPayment($cotisation->payment) }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

    {{ $cotisations->render() }}

    @if($somme > 0)
    <p STYLE="text-align: right">La somme des cotisation impayés est :{{$somme}} TND</p>
    @endif

    </div>

</div>

@endsection
