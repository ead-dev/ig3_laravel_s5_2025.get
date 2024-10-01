@extends('Layouts.client')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Livraisons</a></li>
       <li class="breadcrumb-item active" aria-current="page">Suivi des livraisons</li>
    </ol>
 </nav>
@endsection


@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Suivi des livraisons</h5>
        <p class="lead">Centrale de suivi de toutes les livraisons </p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Cooperative</th>
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
                    @foreach($livraisons as $item)
                        <tr>
                            <th>{{ $item->cooperative->name }}</th>
                            <td>{{ number_format($item->quantity,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->price,0,',','.') }} fcfa</td>
                            <td>{{ number_format($item->total,0,',','.') }} fcfa</td>
                            <td>{{ $item->village?$item->village->name:$item->arrondissement->name }}</td>
                            <td><a href="#">{{ $item->saison?$item->saison->name:'-' }}</a></td>
                            <td><span class="badge bg-{{ $item->status['color']}}">{{ $item->status['name'] }}</span></td>
                            <td>{{ $item->accepted_at?$item->accepted_dt->format('d/m/Y'):'-' }}</td>
                            <td>{{ $item->delivered_at?$item->delivered_dt->format('d/m/Y'):'-' }}</td>
                            <td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                           Actions
                                           <span class="vr"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if($item->status['code']==0)
                                                <li><a class="dropdown-item btn-validate" data-bs-toggle="modal" data-bs-target="#confirmModal" data-day="{{ $item->jour }}" data-client="{{ $item->cooperative }}" data-lieu="{{ $item->village?$item->village->name:$item->arrondissement->name }}" data-livraison="{{ $item }}"  href="#">Valider la livraison</a></li>
                                            @endif

                                        </ul>
                                     </div>
                                </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Confirmation</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('client.livraison.validate') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" id="token">
                            <div class="">
                                <h6 class="text-danger">Attention cette operation est irreversible!</h6>
                                <p>Livraison de <span class="text-danger" id="qty"></span> tonnes au producteur  <span class="text-danger" id="cooperative_name"></span> effectuée le <span class="text-danger" id="day"></span> au lieu dit <span class="text-danger" id="lieu"></span></p>
                                <p>Voulez-vous vraiment confirmer la validation de cette livraison!</p>
                            </div>
                        <div class="mt-5">
                            <a data-bs-dismiss="modal" class="btn-danger btn btn-sm">Annuler</a>
                            <button type="submit" class="btn-success btn btn-sm">Je valide</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.btn-validate').click(function(){
                console.log($(this).data('client'))
                console.log($(this).data('livraison'))
                 var client = $(this).data('client');
                 var lieu = $(this).data('lieu');
                 var day = $(this).data('day');
                 var livraison = $(this).data('livraison');
                 $('#day').text(day);
                 $('#cooperative_name').text(client.name);
                 $('#qty').text(livraison.quantity);
                 $('#lieu').text(lieu);
                 $('#token').val(livraison.token);
                 //console.log(lieu)
                 //console.log(livraison)
            })
        })
    </script>
@endsection
