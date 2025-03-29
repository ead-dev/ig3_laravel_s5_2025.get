@extends('../Layouts/main')
@section('principal')
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
@endsection

@section('title',$elt->name)


