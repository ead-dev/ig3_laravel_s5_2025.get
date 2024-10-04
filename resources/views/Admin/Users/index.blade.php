@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Comptes utilisateurs</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des comptes</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Comptes utilisateurs</h5>
        <p class="lead">Liste de tous les comptes utilisateurs</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="height: 70vh; overflow:scroll;" class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email de connexion</th>
                        <th>Role</th>
                        <th>Bassin</th>
                        <th>Cooperative</th>
                        <th>Client</th>
                        <th>Banque</th>
                        <th>statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img style="width: 30px; border-radius:50%" src="{{ $user->photo }}" alt=""></td>
                            <td><a href="#">{{ $user->name }}</a></td>

                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role?$user->role->name:'-' }}</td>
                            <td>{{ $user->departement?$user->departement->name:'-' }}</td>
                            <td>{{ $user->cooperative?$user->cooperative->name:'-' }}</td>
                            <td>{{ $user->client?$user->client->name:'-' }}</td>
                            <td>{{ $user->banque?$user->banque->name:'-' }}</td>
                            <td><span class="badge bg-{{ $user->status['color'] }}">{{ $user->status['name'] }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                       Actions
                                       <span class="vr"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if($user->active)
                                            <li><a class="dropdown-item" href="{{ route('admin.user.disable',$user->id) }}">Bloquer</a></li>
                                        @else
                                            <li><a class="dropdown-item" href="{{ route('admin.user.enable',$user->id) }}">Activer</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
