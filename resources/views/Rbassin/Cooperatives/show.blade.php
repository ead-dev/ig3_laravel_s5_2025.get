@extends('Layouts.rbassin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Cooperatives</a></li>
       <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
    </ol>
 </nav>
@endsection


@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">{{ $item->name }}</h5>
        <p class="lead">Infos sur la cooperative {{ $item->name }} </p>
    </div>
@endsection

@section('content')
    <div class="d-flex gap-2">
        <div class="w-25">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <div class="d-flex justify-content-center flex-column">
                            <img style="vertical-align: middle" class="image-circle image-thumnail image-75"  src="{{ $item->photo }}" alt="">
                        </div>
                        <div id="d-text" class="d-flex justify-content-center flex-column">
                            <p>COOPERATIVE : {{ $item->name }}</p>
                            <p>Arrondissement : <span class="badge bg-dark">{{ $item->arrondissement?$item->arrondissement->name:'-' }} </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-fill">
            <div class="card">
                <div class="card-body">
                    <h6><i class="pli-calendar-4"></i> Calendrier des marches</h6>
                    <fieldset>
                        @if($calendrier)
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Lieu</th>
                                        <th>Villages Concernés</th>
                                        <th>Stock attendu</th>
                                        <th>
                                            <a data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-xs btn-outline-dark fs-6" href=""><i class="pli-add fs-6 me-2"> Inserer une ligne</i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($calendrier->items as $item)
                                            <tr>
                                                <td>{{ $item->day? \Carbon\Carbon::parse($item->day)->format('d/m/Y'):'-' }}</td>
                                                <td>{{ $item->lieu }}</td>
                                                <td>
                                                    @foreach($item->villages as $village)
                                                        <span class="badge bg-primary">{{ $village->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->prevision?$item->prevision->quantity." tonnes":'non defini' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                        <span class="vr"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('rbassin.protocole.calendar.item.show',$item->token) }}">Afficher</a></li>
    
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
    
    
                                </tbody>
                            </table>
                            @else
                                <div class="">
                                    <div class="text-center">
                                        <a href="{{ route('rbassin.cooperative.calendar',$item->token) }}" class="btn btn-sm btn-primary"><i class="pli-file-edit"></i> Editer le calendrier de la saison</a>
                                    </div>
                                </div>
                            @endif
                    </fieldset>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h6><i class="pli-conference"></i> Liste des adhérents</h6>
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NOM</th>
                                <th>PRENOM</th>
                                <th>AGE</th>
                                <th>VILLAGE</th>
                                <th>TELEPHONE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exploitants as $it)
                                <tr>
                                    <td>{{ $it->last_name }}</td>
                                    <td>{{ $it->first_name }}</td>
                                    <td>{{ $it->age }} ans</td>
                                    <td>{{ $it->village?$it->village->name:'-' }}</td>
                                    <td>{{ $it->phone }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle hstack gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                               Actions
                                               <span class="vr"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                               <li><a class="dropdown-item" href="{{ route('rbassin.members.show',$it->token) }}">Afficher</a></li>
                                            </ul>
                                         </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @isset($calendrier)
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Nouvelle ligne du calendrier</h5>
                    <div style="float: right">
                        <button data-bs-dismiss="modal" class="btn btn-sm" >x</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('rbassin.protocole.calendar.item') }}" method="post">
                        @csrf
                        <input type="hidden" name="calendrier_id" value="{{$calendrier->id}}" />
                        <div class="d-flex gap-2 flex-grow">
                            <div class="">
                                <label for="">DATE</label>
                                <input type="date" required name="day"  class="form-control">
                            </div>
                            <div class="flex-fill">
                                <label for="">Lieu</label>
                                <input required type="text" maxlength="50" placeholder="Lieu du marche" name="lieu" class="form-control">
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
    
    @endisset
@endsection
