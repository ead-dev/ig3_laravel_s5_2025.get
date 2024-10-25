@extends('Layouts.client')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Commandes</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des commandes</li>
    </ol>
 </nav>
@endsection

@section('actions')
    <a href="#" data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="demo-pli-add me-2 fs-5"></i> Ajouter</a>
@endsection


@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Commandes </h5>
        <p class="lead">Liste de toutes les commandes  </p>
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
                        <th>Quantité grade 1</th>
                        <th>Quantité grade 2</th>
                        <th>Quantité HS</th>
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
                            <td>{{ number_format($item->grd1_qty,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->grd2_qty,0,',','.') }} tonne(s)</td>
                            <td>{{ number_format($item->hs_qty,0,',','.') }} tonne(s)</td>
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
                                       <li><a class="dropdown-item" href="{{ route('client.precommandes.show',$item->token) }}">Afficher</a></li> 
                                       @if(!$item->cancelled_at)
                                        <li><a class="dropdown-item" href="{{ route('client.precommande.cancel',$item->token) }}">Annuler</a></li> 
                                       @endif
                                    </ul>
                                 </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Nouvelle commande</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('client.precommandes.store') }}" method="post">
                        @csrf
                            <div class="">
                                <div class="">
                                    <label for="">CONTRATS</label>
                                    <select name="contrat_id" id="" required class="form-control">
                                        @foreach($contrats as $contrat)
                                            <option value="{{ $contrat->id }}">{{ $contrat->saison->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label for="">Quantité grade 1</label>
                                    <input required type="number" placeholder="Saisir la quantite du grade 1"  name="grd1_qty" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label for="">Quantité grade 2</label>
                                    <input required type="number" placeholder="Saisir la quantite du grade 2"  name="grd2_qty" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label for="">Quantité HS</label>
                                    <input required type="number" value="0" placeholder="Saisir la quantite du hors standard"  name="hs_qty" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label for="">Date de livraison souhaitée</label>
                                    <input required type="date"   name="day" class="form-control">
                                </div>
                            </div>
                        <div class="mt-5">
                            <button type="submit" class="btn-primary btn">ENREGISTRER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
