@extends('Layouts.operateur')

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
            <li><a data-bs-toggle="modal" data-bs-target="#addModal" class="dropdown-item" href="#">Inserer un ligne dans le devis</a></li>
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
                <p>Sur contrat de <span class="badge bg-primary">{{ $item->contrat->quantity }} tonnes</span> avec execution de <span class="badge bg-primary">{{ $item->contrat->qtyl }} tonnes</span></p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Nouvelle ligne</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('operateur.invoices.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $item->id }}">
                        <fieldset>
                            <legend>Stock</legend>
                            <div class="d-flex gap-2 flex-grow">
                                <div class="w-25">
                                    <label for="">REGION</label>
                                    <select required name="region_id" id="region_id" class="form-control">
                                        <option value="">Selectionner une region ...</option>
                                        @foreach($regions as $reg)
                                            <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-25">
                                    <label for="">BASSIN DE PRODUCTION</label>
                                    <select required name="departement_id" id="departement_id" class="form-control">
                                        <option value="">Selectionner un bassin de production ...</option>
                                    </select>
                                </div>
                                <div class="w-50">
                                    <label for="">ARRONDISSEMENT</label>
                                    <select required name="arrondissement_id" id="arrondissement_id" class="form-control">
                                        <option value="">Selectionner un arrondissement ...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-grow">
                                <div class="w-50">
                                    <label for="">PRODUCTEUR</label>
                                    <select required name="cooperative_id" id="cooperative_id" class="form-control">
                                        <option value="">Selectionner un producteur ...</option>
                                    </select>
                                </div>
                                <div class="w-50">
                                    <label for="">CALENDRIER ET PREVISION DE STOCK</label>
                                    <select required name="prevision_id" id="calendar_id" class="form-control">
                                        <option value="">Selectionner un jour de marche ...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="">
                                    <label for="">GRADE 1</label>
                                    <input readonly type="text"  id="_grd1_qty" value="0" placeholder="Quantite du grade 1" class="form-control">
                                </div>
                                <div class="">
                                    <label for="">GRADE 2</label>
                                    <input readonly type="text" id="_grd2_qty" value="0" placeholder="Quantite du grade 2" class="form-control">
                                </div>
                                <div class="">
                                    <label for="">H S</label>
                                    <input readonly type="text" id="_hs_qty" value="0" placeholder="Quantite du hs" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>FACTURATION</legend>
                            <div class="d-flex gap-1">
                                <fieldset>
                                    <legend>GRADE 1</legend>
                                    <div class="">
                                        <label for="">QUANTITE</label>
                                        <input required type="number" name="grd1_qty" value="0" class="form-control">
                                    </div>
                                    <div class="">
                                        <label for="">PRIX DU KILO</label>
                                        <input required type="number" name="grd1_price" value="0" class="form-control">
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>GRADE 2</legend>
                                    <div class="">
                                        <label for="">QUANTITE</label>
                                        <input required type="number" name="grd2_qty" value="0" class="form-control">
                                    </div>
                                    <div class="">
                                        <label for="">PRIX DU KILO</label>
                                        <input required type="number" name="grd2_price" value="0" class="form-control">
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>HS</legend>
                                    <div class="">
                                        <label for="">QUANTITE</label>
                                        <input required type="number" name="hs_qty" value="0" class="form-control">
                                    </div>
                                    <div class="">
                                        <label for="">PRIX DU KILO</label>
                                        <input required type="number" name="hs_price" value="0" class="form-control">
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>
                        <div class="mt-5">
                            <button type="submit" class="btn-success btn btn-sm"><i class="pli-add"></i> Inserer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#region_id').change(function(){
                 var _id = $('#region_id').val();
                $.ajax({
                    url: "{{ route('util.region.departements') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#departement_id').html("<option value=0>Choisir un departement ...</option>");
                        data.forEach(element => {
                            $('#departement_id').append(`<option value=${element.id}>${element.name}</option>`);
                        });
    
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })
    
            $('#departement_id').change(function(){
                var _id = $('#departement_id').val();
                $.ajax({
                    url:"{{ route('util.departement.arrondissements') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#arrondissement_id').html("<option value=0>Choisir un arrondissement ...</option>");
                        data.forEach(element => {
                            $('#arrondissement_id').append(`<option value=${element.id}>${element.name}</option>`);
                        });
    
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })

            $('#arrondissement_id').change(function(){
                var _id = $('#arrondissement_id').val();
                $.ajax({
                    url:"{{ route('util.arrondissement.cooperatives') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#cooperative_id').html("<option value=0>Choisir une organisation de producteurs ...</option>");
                        data.forEach(element => {
                            $('#cooperative_id').append(`<option value=${element.id}>${element.name}</option>`);
                        });
    
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })

            $('#cooperative_id').change(function(){
                var _id = $('#cooperative_id').val();
                $.ajax({
                    url:"{{ route('util.cooperative.calendar_items') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#calendar_id').html("<option value=0>Choisir une date ...</option>");
                        data.forEach(element => {
                            $('#calendar_id').append(`<option value=${element.id}>${element.name}</option>`);
                        });
    
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })

            $('#calendar_id').change(function(){
                var _id = $('#calendar_id').val();
                $.ajax({
                    url:"{{ route('util.prevision') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#_grd1_qty').val(data.grd1_qty);
                        $('#_grd2_qty').val(data.grd2_qty);
                        $('#_hs_qty').val(data.hs_qty);
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })
        })
    </script>
@endsection
