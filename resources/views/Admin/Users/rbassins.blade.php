@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Points Focaux</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des operateurs</li>
    </ol>
 </nav>
@endsection

@section('actions')
    <a href="#" data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="demo-pli-add me-2 fs-5"></i> Ajouter</a>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Points Focaux</h5>
        <p class="lead">Liste de tous les points focaux</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NOM</th>
                        <th>EMAIL</th>
                        <th>DEPARTEMENT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rbassins as $item)
                        <tr>
                            <td><img class="image-25 image-circle" src="{{ $item->photo }}" alt="{{ $item->name }}"></td>
                            <td><a href="{{ route('admin.rbassins.show',$item->token) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->departement->name }}</td>
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
                    <h5 class="modal-title">Nouveau point focal</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('admin.rbassins.store') }}" method="post">
                        @csrf
                            <div class="">
                                <div class="form-group">
                                    <label for="">NOM</label>
                                    <input required type="text" name="name" placeholder="Saisir le nom de l'operateur" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">REGION</label>
                                    <select required name="region_id" id="region_id" class="form-control">
                                        <option value="0">Selectionner une region ...</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">DEPARTEMENT</label>
                                    <select required name="departement_id" id="departement_id" class="form-control">
                                        <option value="0">Selectionner un departement ...</option>
                                    </select>
                                </div>
                                <fieldset>
                                    <legend>Infos de connexion</legend>
                                    <div class="">
                                        <label for="">EMAIL</label>
                                        <input required type="email" name="email" placeholder="Saisir l'email de connexion" class="form-control">
                                    </div>
                                    <div class="">
                                        <label for="">MOT DE PASSE</label>
                                        <input required type="password" name="password" placeholder="Saisir le mot de passe" class="form-control">
                                    </div>
                                </fieldset>

                            </div>
                        <div class="mt-5">
                            <button type="submit" class="btn-success btn-sm btn"><i class="pli-save fs-5 me-2"></i> ENREGISTRER</button>
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
        })
    </script>
@endsection
