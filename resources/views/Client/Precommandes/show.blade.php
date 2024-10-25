@extends('Layouts.client')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">commandes</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">COMMNADE &numero; {{ $item->name }}</h5>
        <p class="lead">Details sur la commande</p>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header">
                <h6 class="mb-0">status <span class="badge bg-{{ $item->status['color'] }}">{{ $item->status['name'] }}</span></h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>Date d'emission : <strong class="text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</strong></p>
                    <p>Date de livraison souhaitée : <strong class="text-muted">{{ \Carbon\Carbon::parse($item->day)->format('d/m/Y') }}</strong></p>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>QUANTITE GRADE 1</th>
                            <th>QUANTITE GRADE 2</th>
                            <th>QUANTITE HS</th>
                            <th>QUANTITE TOTALE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ $item->grd1_qty }} tonnes</th>
                            <th>{{ $item->grd2_qty }} tonnes</th>
                            <th>{{ $item->hs_qty }} tonnes</th>
                            <th>{{ $item->quantity }} tonnes</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
