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
                <th>&numero;</th>
                <th>CLIENT</th>
                <th>QUANTITE</th>
                <th>TOTAL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($items as $item)
               <tr>
                    <td>{{ $item->created_at?$item->created_at->format('d/m/Y H:i'):'-' }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->client?->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->total,0,',','.') }}</td>
                    <td>
                        <a class="btn btn-info btn-xs" href="/commandes/{{ $item->id }}">Afficher</a>
                        <a class="btn btn-warning btn-xs" href="/commandes/edit/{{ $item->id }}">Modifier</a>
                        
                    </td>
               </tr>
           @endforeach
        </tbody>
    </table>
    
    </div>
@endsection