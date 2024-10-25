@extends('Layouts.rbassin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">KeKa</a></li>
        <li class="breadcrumb-item"><a href="#">Producteurs</a></li>
        <li class="breadcrumb-item"><a href="#">Contrats</a></li>
        <li class="breadcrumb-item"><a href="#">Calendrier de collecte - {{ $item->cooperative->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Journée du {{ $item->jour->format('d/m/Y') }}</li>
     </ol>
 </nav>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Journée du {{ $item->jour->format('d/m/Y') }}</h5>
        <p class="lead">Détails de la Journée du {{ $item->jour->format('d/m/Y') }}</p>
    </div>
@endsection

@section('actions')
    <div class="btn-group">
        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
        <span class="vr"></span>
        </button>
        <ul class="dropdown-menu">
            @if($item->prevision)
                <a href="#" data-bs-target="#editModal" data-bs-toggle="modal" class="dropdown-item"><i class="pli-file-edit"></i>Modifier les previsions</a>
            @else
                <a href="#" data-bs-target="#addModal" data-bs-toggle="modal" class="dropdown-item"><i class="pli-file-edit"></i>Editer les previsions</a>
            @endif
            <a href="#" data-bs-target="#addVillageModal" data-bs-toggle="modal" class="dropdown-item"><i class="pli-map-marker"></i>Associer un village</a>                            
        </ul>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-center gap-1">
        <div class="card" style="width:45%">
            <div class="">
                <div class="d-flex gap-2">
                    <div class="w-50">
                        <img style="width:100%; height:100%; background-size: cover;" class=""  src="{{ $item->cooperative->photo }}" alt="">
                    </div>
                    <div id="d-text" class="d-flex justify-content-center flex-column p-3">
                        <p class="fs-4 text-dark border-bottom border-2 border-primary">COOPERATIVE : {{ $item->cooperative->name }}</p>
                        <p>SAISON : {{ $item->saison->name }}</p>
                        <p>Lieu : <span class="badge bg-dark">{{ $item->lieu }} </span></p>
                        <p>Arrondissement : <span class="badge bg-dark">{{ $item->arrondissement?$item->arrondissement->name:'-' }} </span></p>

                        @if($item->prevision)
                            <fieldset>
                                <legend>Stock prévisonnel</legend>
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>GRADE 1</th>
                                            <th>GRADE 2</th>
                                            <th>HS</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->prevision->grd1_qty }}</td>
                                            <td>{{ $item->prevision->grd2_qty }}</td>
                                            <td>{{ $item->prevision->hs_qty }}</td>
                                            <td>{{ $item->prevision->quantity }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <p>Stock engagé : <span class="badge bg-dark">{{ $item->qtyl }} tonne(s)</span></p>
                            <p>Stock restant : <span class="badge bg-dark">{{ $item->qtyl }} tonne(s)</span></p>
                            
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <fieldset>
                    <legend>Liste des villages concernés</legend>
                    @foreach($item->villages as $vil)
                        <span class="badge bg-primary">{{ $vil->name }}</span>
                    @endforeach
                </fieldset>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Saisie du stock prévisionnel</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('rbassin.previsions.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div>
                            <div class="form-group">
                                <label for="">JOUR DU MARCHE</label>
                                <input type="date" readonly required value="{{ $item->day }}" placeholder="Jour du marche" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">LIEU DU MARCHE</label>
                                <input type="text" readonly required value="{{ $item->lieu }}" placeholder="lieu du marche" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage grade 1</label>
                                <input type="number" required name="grd1_qty" placeholder="Saisir le tonnage du grade 1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage grade 2</label>
                                <input type="number" required name="grd2_qty" placeholder="Saisir le tonnage du grade 2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage HS</label>
                                <input type="number" required name="hs_qty" placeholder="Saisir le tonnage du HS" class="form-control">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn-success btn"><i class="pli-save fs-5 me-2"></i> ENREGISTRER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($item->prevision)
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Modification du stock previsionnel</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('rbassin.prevision.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->prevision->id }}">
                        <div>
                            <div class="form-group">
                                <label for="">JOUR DU MARCHE</label>
                                <input type="date" readonly required value="{{ $item->day }}" placeholder="Jour du marche" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">LIEU DU MARCHE</label>
                                <input type="text" readonly required value="{{ $item->lieu }}" placeholder="lieu du marche" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage grade 1</label>
                                <input type="number" required name="grd1_qty" value="{{ $item->prevision->grd1_qty }}" placeholder="Saisir le tonnage du grade 1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage grade 2</label>
                                <input type="number" required name="grd2_qty" value="{{ $item->prevision->grd2_qty }}" placeholder="Saisir le tonnage du grade 2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tonnage HS</label>
                                <input type="number" required name="hs_qty" value="{{ $item->prevision->hs_qty }}" placeholder="Saisir le tonnage du HS" class="form-control">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn-success btn"><i class="pli-save fs-5 me-2"></i> ENREGISTRER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="addVillageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Associer un village au calendrier</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('rbassin.calendar.village') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="d-flex gap-1">
                            <div class="form-group flex-fill">
                                <label for="">Village</label>
                                <select name="village_id" required id="" class="form-control">
                                    <option value="">Selectionner un village de l'arrondissement ...</option>
                                    @foreach($villages as $village)
                                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn-success btn"><i class="pli-save fs-5 me-2"></i> ENREGISTRER</button>
                            </div>
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
                    url:"{{ route('util.arrondissement.villages') }}",
                    type:'get',
                    dataType:'json',
                    data:{id:_id},
                    success:function(data){
                        $('#villages_id').html("<option value='0'>Choisir un village ...</option>");
                        data.forEach(element => {
                            $('#village_id').append(`<option value=${element.id}>${element.name}</option>`);
                        });

                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            })
        })
    </script>

    <style>
        .form-group{
            margin-top: 10px;
        }
        #d-text p{
            margin: 2px 2px;
            font-weight: 600;
        }

        .card p{
            margin: 2px 2px;
        }
    </style>

@endsection
