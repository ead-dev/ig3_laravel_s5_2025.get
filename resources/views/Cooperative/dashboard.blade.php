@extends('Layouts.cooperative')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
       <li class="breadcrumb-item active" aria-current="page">Accueil</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">ACCUEIL</h5>
        <p class="lead">Hello {{ auth()->user()->name }}, bienvenu sur <span class="text-muted">KeKa</span> votre plateforme de trading de la feve!</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Espace du producteur</h2>
        </div>
    </div>
@endsection
