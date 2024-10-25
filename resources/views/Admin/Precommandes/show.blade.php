@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Précommandes</a></li>
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

@section('actions')
    <div class="btn-group">
        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
        <span class="vr"></span>
        </button>
        <ul class="dropdown-menu">
            @if($item->order)
                <li><a class="dropdown-item" href="{{ route('admin.invoices.show',$item->order->token) }}">Afficher la commande</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header d-flex justify-content-between">
                <h6 class="mb-0">status <span class="badge bg-{{ $item->status['color'] }}">{{ $item->status['name'] }}</span></h6>
                <p class="mb-0">CLIENT: <span class="badge bg-primary">{{ $item->client->name }}</span></p>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>Date d'emission : <strong class="badge bg-primary">{{ $item->created_at->format('d/m/Y H:i') }}</strong></p>
                    <p>Date de livraison souhaitée : <strong class="badge bg-primary">{{ \Carbon\Carbon::parse($item->day)->format('d/m/Y') }}</strong></p>
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
            <div class="card-footer">
                <p>Sur contrat de <span class="badge bg-primary">{{ $item->contrat->quantity }} tonnes</span> avec execution de <span class="badge bg-primary">{{ $item->contrat->qtyl }} tonnes</span></p>
            </div>
        </div>
    </div>

@endsection
