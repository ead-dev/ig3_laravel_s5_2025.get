<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil | FOODIES</title>
</head>
<body>
    <h1>BIENVENUE SUR FOODIES</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
