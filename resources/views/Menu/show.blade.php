<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
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
        <h1>{{ $elt->name }}</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>NOM</td>
                                    <th>{{ $elt->name }}</th>
                                </tr>
                                <tr>
                                    <td>PRIX</td>
                                    <th>{{ number_format($elt->pu,0,',','.') }} FCFA</th>
                                </tr>
                                <tr>
                                    <td>CATEGORIE</td>
                                    <th>{{ $elt->category->name }}</th>
                                </tr>
                            </tbody>
                        </table>
                        <p>{{ $elt->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
