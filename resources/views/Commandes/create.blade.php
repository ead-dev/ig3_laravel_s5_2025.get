@extends('../Layouts/main')
@section('principal')
<div class="container mt-4">
        <h1>FORMULAIRE DE CREATION D'UNE COMMANDE</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="/menu" method="post">
                            @csrf
                            <div class="mt-3">
                                <label for="">ELEMENT DE MENU</label>
                                <select required name="category_id" class="form-control" id="">
                                    <option value="">Choisir un repas au menu ...</option>
                                    @foreach ($repas as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="">PRIX UNITAIRE</label>
                                <input type="number" required name="pu" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">NOMBRE DE PLATS</label>
                                <input type="number" required name="quantity" value="1" class="form-control">
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-success">ENREGISTRER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
