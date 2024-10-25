@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Factures et devis</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
    </ol>
 </nav>
@endsection

@section('actions')
    <div class="btn-group">
        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
        <span class="vr"></span>
        </button>
        <ul class="dropdown-menu">
            @if($item->active)
                <li><a class="dropdown-item" href="{{ route('admin.invoice.validate',$item->token) }}">Approuver</a></li>
            @endif    
        </ul>
    </div>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">OFFRE &numero; {{ $item->name }}</h5>
        <p class="lead">Détails de l'offre commerciale</p>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="mb-0">status <span class="badge bg-{{ $item->status['color'] }}">{{ $item->status['name'] }}</span></h6>
                <p class="mb-0">CLIENT: <span class="badge bg-primary">{{ $item->client->name }}</span></p>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>Date d'emission : <strong class="badge bg-primary">{{ $item->created_at->format('d/m/Y H:i') }}</strong></p>
                    <p>Date de livraison souhaitée : <strong class="badge bg-primary">{{ \Carbon\Carbon::parse($item->day)->format('d/m/Y') }}</strong></p>
                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-center" colspan="4">QUANTITES</th>
                            <th class="text-center" colspan="4">PRIX</th>
                        </tr>
                        <tr>
                            <th>DATE DE RAMASSAGE</th>
                            <th>LIEU DE RAMASSAGE</th>
                            <th>PRODUCTEUR</th>
                            <th>QUANTITE GRADE 1</th>
                            <th>QUANTITE GRADE 2</th>
                            <th>QUANTITE HS</th>
                            <th>QUANTITE TOTALE</th>
                            <th>PRIX/KG GRADE 1</th>
                            <th>PRIX/KG GRADE 2</th>
                            <th>PRIX/KG HS</th>
                            <th>MONTANT TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item->items as $it)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($it->day)->format('d/m/Y')  }}</td>
                                <td>{{ $it->lieu  }}</td>
                                <td>{{ $it->cooperative->name  }}</td>
                                <td>{{ $it->grd1_qty }} tonnes</td>
                                <td>{{ $it->grd2_qty }} tonnes</td>
                                <td>{{ $it->hs_qty }} tonnes</td>
                                <th>{{ $it->quantity }} tonnes</th>
                                <td>{{ $it->grd1_price }}</td>
                                <td>{{ $it->grd2_price }}</td>
                                <td>{{ $it->hs_price }}</td>
                                <th>{{ number_format($it->total,0,',','.') }} FCFA</th>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="6">Total</th>
                            <th>{{ $item->quantity }} tonnes</th>
                            <td colspan="3"></td>
                            <th>{{ number_format($item->total,0,',','.') }} FCFA</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>

 
@endsection
