@extends('Layouts.app')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Mon profil</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">{{ $user->name }}</h5>
        <p class="lead">Edition du profil</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{ route('profile.store') }}" method="post">
                @csrf
                <div class="d-flex gap-2 flex-grow">
                        <div class=" w-75">
                            <label for="">NOM DE L'UTILISATEUR</label>
                            <input required type="text" name="username" placeholder="Saisir le nom de l'utilisateur" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-grow">
                        <div class="form-group w-50">
                            <label for="">EMAIL DE CONNEXION</label>
                            <input required type="email" name="email" placeholder="Saisir l'adresse email de connexion de l'utilisateur" class="form-control">
                        </div>
                        <div class="form-group w-50">
                            <label for="">MOT DE PASSE</label>
                            <input required type="password" name="password" placeholder="Saisir le mot de passe de connexion de l'utilisateur" class="form-control">
                        </div>
                    </div>
                <div class="mt-5">
                    <button type="submit" class="btn-primary btn">ENREGISTRER</button>
                </div>
            </form>
        </div>
    </div>


    <style>
        .form-group{
            margin-top: 1rem;
        }
    </style>
@endsection
