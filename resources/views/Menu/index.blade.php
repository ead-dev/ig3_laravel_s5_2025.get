<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <title>Menu | FOODIES</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary" aria-label="Tenth navbar example">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">ACCUEIL</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/commandes">COMMANDES</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/menu" >MENU</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Parametres</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </div>
    <div class="container mt-4">
        <h1>MENU AU SEIN DU RESTO FOODIES</h1>
        <a class="btn btn-sm btn-primary" href="/menu/create">Ajouter</a>

    <table class="table table-sm table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>REPAS</th>
                <th>PRIX UNITAIRE</th>
                <th>CATEGORIE</th>
                <th>DATE D'AJOUT</th>
                <th>STATUT</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($items as $item)
               <tr>
                    <td>{{ $item->name }}</td>
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
</body>
</html>
