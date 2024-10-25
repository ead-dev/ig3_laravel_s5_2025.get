@extends('Layouts.rbassin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Producteurs</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des producteurs</li>
    </ol>
 </nav>
@endsection


@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Producteurs </h5>
        <p class="lead">Liste des producteurs  </p>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>AGE</th>
                        <th>VILLAGE</th>
                        <th>TELEPHONE</th>
                        <th>COOPERATIVE</th>
                        <th>SITUATION MATRIMONIALE</th>
                        <th>NOMBRE D'ENFANTS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->age }} ans</td>
                            <td>{{ $item->village?$item->village->name:'-' }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->cooperative?$item->cooperative->name:'-' }}</td>
                            <td>{{ $item->situation_matrimoniale }}</td>
                            <td>{{ $item->nb_enfants }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                       Actions
                                       <span class="vr"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                       <li><a class="dropdown-item" href="{{ route('rbassin.members.show',$item->token) }}">Afficher</a></li>
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
