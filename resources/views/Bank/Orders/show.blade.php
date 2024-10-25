@extends('Layouts.bank')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Offres commerciales</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
    </ol>
 </nav>
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
                            <th class="text-center" colspan="3">PRIX/KG</th>
                            <th class="text-center" colspan="4"></th>
                        </tr>
                        <tr>
                            <th>DATE DE RAMASSAGE</th>
                            <th>LIEU DE RAMASSAGE</th>
                            <th>PRODUCTEUR</th>
                            <th>GRADE 1</th>
                            <th>GRADE 2</th>
                            <th>HS</th>
                            <th>TOTAL</th>
                            <th>GRADE 1</th>
                            <th>GRADE 2</th>
                            <th>HS</th>
                            <th>TOTAL</th>
                            <th>VERSEMENT</th>
                            <th>RESTE</th>
                            <th></th>
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
                                <th>{{ number_format($it->versement,0,',','.') }} FCFA</th>
                                <th>{{ number_format($it->reste,0,',','.') }} FCFA</th>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                           Actions
                                           <span class="vr"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                           <li><a data-versement="{{ $it->versement }}" data-reste="{{ $it->reste }}" data-total="{{ $it->total }}" data-id="{{ $it->id }}" data-cooperative="{{ $it->cooperative->name }}" class="dropdown-item btn-add" data-bs-toggle="modal" data-bs-target="#addModal" href="#">Enregistrer un paiement</a></li>
                                        </ul>
                                     </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="6">Total</th>
                            <th>{{ $item->quantity }} tonnes</th>
                            <td colspan="3"></td>
                            <th>{{ number_format($item->total,0,',','.') }} FCFA</th>
                            <th>{{ number_format($item->versement,0,',','.') }} FCFA</th>
                            <th>{{ number_format($item->reste,0,',','.') }} FCFA</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <h6>Historique des paiements</h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th colspan="4">QUANTITES</th>
                            <th colspan="3">PRIX</th>
                            <th></th>
                            <th colspan="3">PAIEMENT</th>
                        </tr>
                        <tr>
                            <th>DATE</th>
                            <th>DATE DE PAIEMENT</th>
                            <th>PRODUCTEUR</th>
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
                        @foreach($item->paiements as $p)
                        <tr>
                            <td>{{ $p->created_at->format('d/m/Y H:i')  }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->day)->format('d/m/Y')  }}</td>
                            <td>{{ $p->item->cooperative->name  }}</td>
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
    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Nouveau paiement</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('bank.invoices.store') }}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <fieldset>
                            <legend>Infos de la facture</legend>
                            <div class="d-flex gap-2 flex-grow">
                                <div class=" w-25">
                                    <label for="">PRODUCTEUR</label>
                                    <input type="text" readonly id="cooperative"  class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">TOTAL FACTURE</label>
                                    <input type="text" readonly id="total"  class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">VERSEMENTS</label>
                                    <input type="text" readonly id="versement" value="0" class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">RESTE</label>
                                    <input type="text" readonly id="reste" value="0"  class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Infos paiement</legend>
                            <div class="d-flex gap-2 ">
                                <div class=" w-25">
                                    <label for="">DATE</label>
                                    <input required type="date" name="day" placeholder="Saisir la date du jour du paiement" class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">MONTANT</label>
                                    <input required type="text" name="montant" placeholder="Saisir le montant du paiement" class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">&numero; de compte</label>
                                    <input required type="text" name="compte" placeholder="Saisir le numero de compte" class="form-control">
                                </div>
                                <div class=" w-25">
                                    <label for="">JUSTIFICATIF</label>
                                    <input required type="file" name="document" placeholder="Justificatif de paiement" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <div class="mt-5">
                            <button type="submit" class="btn-primary btn">ENREGISTRER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.btn-add').click(function(){
                var id = $(this).data('id');
                var cooperative = $(this).data('cooperative');
                var total = $(this).data('total');
                var versement = $(this).data('versement');
                var reste = $(this).data('reste');
                console.log(reste)
                $('#id').val(id);
                $('#cooperative').val(cooperative);
                $('#total').val(total);
                $('#versement').val(versement);
                $('#reste').val(reste);
            })

        })
    </script>

 
@endsection
