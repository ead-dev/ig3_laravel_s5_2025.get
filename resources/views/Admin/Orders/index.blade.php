@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Factures et devis clients</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des factures</li>
    </ol>
 </nav>
@endsection



@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Factures et devis </h5>
        <p class="lead">Liste des factures et devis clients  </p>
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
                        <th>Commande</th>
                        <th>Quantité totale</th>
                        <th>Saison</th>
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
                            <td><a href="{{ $item->precommande?route('operateur.precommandes.show',$item->precommande->token):'#' }}">{{ $item->precommande?$item->precommande->name:'-' }}</a></td>
                            <td>{{ number_format($item->quantity,0,',','.') }} tonne(s)</td>
                            <td><a href="#">{{ $item->saison?$item->saison->name:'-' }}</a></td>
                            <td><span class="badge bg-{{ $item->status['color']}}">{{ $item->status['name'] }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                       Actions
                                       <span class="vr"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                       <li><a class="dropdown-item" href="{{ route('admin.invoices.show',$item->token) }}">Afficher</a></li>

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
