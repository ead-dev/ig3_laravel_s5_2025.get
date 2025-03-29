@extends('../Layouts/main')
@section('principal')
<div class="container mt-4">
        <h1>FORMULAIRE D'AJOUT D'UN MENU</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="/menu" method="post">
                            @csrf
                            <div>
                                <label for="">NOM</label>
                                <input required class="form-control" name="name" placeholder="Saisir le nom du repas" type="text">
                            </div>
                            <div class="mt-3">
                                <label for="">PRIX</label>
                                <input required class="form-control" name="pu" placeholder="Saisir le prix de vente" value="1000" type="number">
                            </div>
                            <div class="mt-3">
                                <label for="">DESCRIPTION</label>
                                <textarea name="description" class="form-control" id="" cols="30" placeholder="Donner une petite description de ce menu" rows="3"></textarea>
                            </div>
                            <div class="mt-3">
                                <label for="">CATEGORIE</label>
                                <select required name="category_id" class="form-control" id="">
                                    <option value="">Choisir une categorie ...</option>
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
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
