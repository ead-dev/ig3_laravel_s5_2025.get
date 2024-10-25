@extends('Layouts.operateur')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">commandes</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des commandes de la saison</li>
    </ol>
 </nav>
@endsection



@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Commandes </h5>
        <p class="lead">Liste de toutes les commandes  de la saison</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>


                        <th>DATE D'EMISSION</th>
                        <th>Date de livraison souhaitée</th>
                        <th>CLIENT</th>
                        <th>Quantité grade 1</th>
                        <th>Quantité grade 2</th>
                        <th>Quantité HS</th>
                        <th>Quantité totale</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->day)->format('d/m/Y') }}</td>
                            <td><a href="#">{{ $item->client?$item->client->name:'-' }}</a></td>
                            <td>{{ number_format($item->grd1_qty,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->grd2_qty,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->hs_qty,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->quantity,0,',','.') }} tonne(s)</td>
                            <td><span class="badge bg-{{ $item->status['color']}}">{{ $item->status['name'] }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                       Actions
                                       <span class="vr"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                       <li><a class="dropdown-item" href="{{ route('operateur.precommandes.show',$item->token) }}">Afficher</a></li>

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

