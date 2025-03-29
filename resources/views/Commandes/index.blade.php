@extends('../Layouts/main')
@section('title','Liste des commandes')
@section('principal')
<div class="container mt-4">
        <h1>LISTE DES COMMANDES</h1>
        <a class="btn btn-sm btn-primary" href="/commandes/create">Ajouter</a>
        <div>
          <form class="mt-4">
              <div class="row">
                  <div class="col-md-3">
                      <select name="active" class="form-control col-md-5">
                          <option value=-1>Tous les statuts</option>
                          <option value=0>DESACTIVE</option>
                          <option value=1>ACTIF</option>
                          
                      </select>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-success">Charger</button>
                  </div>
              </div>
              
              
          </form>
          
        </div>
    <table class="table table-sm table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>DATE</th>
                <th>CLIENT</th>
                <th>QUANTITE</th>
                <th>TOTAL</th>
                <th>STATUT</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($items as $item)
               <tr>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->pu }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->created_at?$item->created_at->format('d/m/Y H:i'):'-' }}</td>
                    <td>{{ $item->active?'actif':'disactive' }}</td>
                    <td>
                        <a class="btn btn-info btn-xs" href="/menu/{{ $item->id }}">Afficher</a>
                        <a class="btn btn-warning btn-xs" href="/menu/edit/{{ $item->id }}">Modifier</a>
                        @if($item->active)
                            <a class="btn btn-primary btn-xs" href="/menu/disable/{{ $item->id }}">Desactiver</a>
                        @else
                            <a class="btn btn-success btn-xs" href="/menu/enable/{{ $item->id }}">Activer</a>
                        @endif
                    </td>
               </tr>
           @endforeach
        </tbody>
    </table>
    
    </div>
@endsection