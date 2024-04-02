@extends('layouts.layout1')
@section('title', 'List des Admins')
@section('content')
<div class="container">
    <div class="row">
        <div class="title col-md-12">
            <h3>Liste des Administrateurs <span class="badge badge-light">{{$users->total() }}</span></h3> 
        </div>
    </div>
    <div class="row">
        @if (Route::has('login'))
        <div class="col-md-12 link-create-user">
            @auth
            <a href="{{ route('showCreateUser') }}" class="btn btn-primary">Ajouter Admin</a>
            @endauth
        </div>
    @endif</div>
    {{-- liste des admins--}}
    <div class="row table-responsive-md justify-content-center">
        <table class="table table-hover table-striped col-md-10 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Profil</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td scope="row">{{ $user->nom }} </td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email}}</td>
                    <td >
                        <a href="{{ route('showUser',$user->id) }}">
                            <i class="fas fa-user-circle  fa-2x"></i>
                        </a> 
                    </td>
                    <td>
                    <a href="{{ route('showUpdateUser',$user->id) }}"><i class="fas fa-edit btn btn-primary" ></i></a>
                    </td>
                    <td>
                    <a  href="{{ route('deleteUser',$user->id) }}" onclick="return confirm('voulez-vous vraiment supprimer cet Administrateur ')"> <i class="fas fa-trash-alt btn btn-danger"></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{ $users ->render() }}

        {{-- fin liste des medecin --}}
    </div>
    <div class="col-md-12 submit-center">
   <a href="{{route('showParametre')}}" class="btn btn-danger btn-rechercher">Retour </a>
  </div> 
</div>
@endsection