@extends('Layouts.bank')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Contrats acheteurs</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $contrat->name }}</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">{{ $contrat->name }}</h5>
        <p class="lead">Details sur le contrat</p>
    </div>
@endsection

@section('content')
    <div class="d-flex gap-1">
        <div class="card w-25">
            <div class="card-body">
                <h5>Client : {{ $contrat->client->name }}</h5>
                <h6>Saison : {{ $contrat->saison->name }}</h6>
            </div>
        </div>
        <div class="card w-75">
            
            <div class="card-body">
                <h6>Livraisons</h6>
                <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Acheteur</th>
                        <th>Producteur</th>
                        <th>Quantité</th>
                        <th>Prix/kg</th>
                        <th>Total</th>
                        <th>Lieu de ramassage</th>
                        <th>Saison</th>
                        <th>Status</th>
                        <th>Validé le</th>
                        <th>Livré le</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrat->livraisons as $item)
                        <tr>
                            <td><a href="#">{{ $item->client?$item->client->name:'-' }}</a></td>
                            <td><a href="#">{{ $item->cooperative?$item->cooperative->name:'-' }}</a></td>
                            <td>{{ number_format($item->quantity,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->price,0,',','.') }} fcfa</td>
                            <td>{{ number_format($item->total,0,',','.') }} fcfa</td>
                            <td>{{ $item->village?$item->village->name:$item->arrondissement->name }}</td>
                            <td><a href="#">{{ $item->saison?$item->saison->name:'-' }}</a></td>
                            <td><span class="badge bg-{{ $item->status['color']}}">{{ $item->status['name'] }}</span></td>
                            <td>{{ $item->accepted_at?$item->accepted_dt->format('d/m/Y'):'-' }}</td>
                            <td>{{ $item->delivered_at?$item->delivered_dt->format('d/m/Y'):'-' }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

@endsection
