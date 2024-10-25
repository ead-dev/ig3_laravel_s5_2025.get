@extends('Layouts.bank')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Paiements</a></li>
       <li class="breadcrumb-item active" aria-current="page">Historique des paiements</li>
    </ol>
 </nav>
@endsection


@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Historique des paiements</h5>
        <p class="lead">Historique de tous les paiements de la saison </p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th colspan="5"></th>
                        <th colspan="4">QUANTITES</th>
                        <th colspan="3">PRIX</th>
                        <th></th>
                        <th colspan="3">PAIEMENT</th>
                    </tr>
                    <tr>
                        <th>DATE</th>
                        <th>DATE DE PAIEMENT</th>
                        <th>PRODUCTEUR</th>
                        <th>ACHETEUR</th>
                        <th>FACTURE</th>
                        <th>GRADE 1</th>
                        <th>GRADE 2</th>
                        <th>HS</th>
                        <th>TOTAL</th>
                        <th>GRADE 1</th>
                        <th>GRADE 2</th>
                        <th>HS</th>
                        <th>TOTAL</th>
                        <th>MONTANT</th>
                        <th>COMPTE</th>
                        <th>JUSTIFICATIF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $p)
                    <tr>
                        <td>{{ $p->created_at->format('d/m/Y H:i')  }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->day)->format('d/m/Y')  }}</td>
                        <td>{{ $p->item->cooperative->name  }}</td>
                        <td>{{ $p->item->client->name }}</td>
                        <td><a href="{{ route('bank.invoices.show',$p->order->token) }}">{{ $p->order->name }}</a></td>
                        <td>{{ $p->item->grd1_qty }} tonnes</td>
                        <td>{{ $p->item->grd2_qty }} tonnes</td>
                        <td>{{ $p->item->hs_qty }} tonnes</td>
                        <th>{{ $p->item->quantity }} tonnes</th>
                        <td>{{ $p->item->grd1_price }}</td>
                        <td>{{ $p->item->grd2_price }}</td>
                        <td>{{ $p->item->hs_price }}</td>
                        <th>{{ number_format($p->item->total,0,',','.') }} FCFA</th>
                        <th>{{ number_format($p->montant,0,',','.') }} FCFA</th>
                        <td>{{ $p->compte }}</td>
                        <td><a href="{{ $p->justificatif }}">cliquer ici</a></td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
