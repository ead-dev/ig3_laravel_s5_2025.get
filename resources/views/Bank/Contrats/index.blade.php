@extends('Layouts.bank')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Acheteurs</a></li>
       <li class="breadcrumb-item"><a href="#">Contrats</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des contrats acheteurs</li>
    </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Contrats des acheteurs</h5>
        <p class="lead">Liste de tous les contrats des acheteurs </p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Acheteur</th>
                        <th>Saison</th>
                        <th>Tonnage Prévisionnel</th>
                        <th>Tonnage Exécuté</th>
                        <th>Taux d'exécution</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrats as $item)
                        <tr>
                            <td><a href="#">{{ $item->client?$item->client->name:'-' }}</a></td>
                            <td><a href="#">{{ $item->saison?$item->saison->name:'-' }}</a></td>
                            <td>{{ number_format($item->quantity,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->qtyl,0,',','.') }} tonne(s)</td>
                            <td>{{ $item->percentage }}%</td>
                            <td><span class="badge bg-{{ $item->status['color']}}">{{ $item->status['name'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
