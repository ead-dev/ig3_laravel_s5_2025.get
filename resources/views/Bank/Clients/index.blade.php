@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Acheteurs</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des Acheteurs</li>
    </ol>
 </nav>
@endsection
@section('actions')
    <a href="#" data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="demo-pli-add me-2 fs-5"></i> Ajouter</a>
@endsection

@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Acheteurs</h5>
        <p class="lead">Liste de tous les clients</p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Acheteurs</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Origine</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $item)
                        <tr>
                            <td><a href="{{ route('admin.clients.show',$item->id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->pay?$item->pay->name:'-' }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Nouvel Acheteur</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('admin.clients.store') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Infos de l'acheteur</legend>
                            <div class="d-flex gap-2 flex-grow">
                                <div class=" w-50">
                                    <label for="">NOM</label>
                                    <input type="text" name="name" placeholder="Saisir le nom de l'acheteur" class="form-control">
                                </div>
                                <div>
                                    <label for="">PAYS D'ORIGINE</label>
                                    <select required name="pay_id" id="pay_id" class="form-control">
                                        <option value="">Selectionner un pays ...</option>
                                        @foreach($pays as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="">Logo/Photo</label>
                                    <input required type="file" name="photo" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-grow">
                                <div class="form-group w-50">
                                    <label for="">Adresse</label>
                                    <input required type="text" name="address" placeholder="Adresse physque de la client" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Telephone</label>
                                    <input required type="text" name="phone" placeholder="Numero de telephone de la client" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" name="m-email" placeholder="Adresse email de contact" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Infos de connexion du compte utilisateur de la client</legend>
                            <div class="d-flex gap-2 flex-grow">
                                <div class=" w-75">
                                    <label for="">NOM DE L'UTILISATEUR</label>
                                    <input required type="text" name="username" placeholder="Saisir le nom de l'utilisateur" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-grow">
                                <div class="form-group w-50">
                                    <label for="">EMAIL DE CONNEXION</label>
                                    <input required type="email" name="email" placeholder="Saisir l'adresse email de connexion de l'utilisateur" class="form-control">
                                </div>
                                <div class="form-group w-50">
                                    <label for="">MOT DE PASSE</label>
                                    <input required type="password" name="password" placeholder="Saisir le mot de passe de connexion de l'utilisateur" class="form-control">
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


    <style>
        .form-group{
            margin-top: 1rem;
        }
    </style>
@endsection
