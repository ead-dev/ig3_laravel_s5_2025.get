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
    <div class="container mt-4">
        <h1>MENU AU SEIN DU RESTO FOODIES</h1>

    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>REPAS</th>
                <th>PRIX UNITAIRE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repas as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>
