@extends('Layouts.operateur')

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
    </div>
@endsection

@section('content')
    <div class="d-flex gap-2">
        <div>
            
        </div>
    </div>

    <style>
        .form-group{
            margin-top: 1rem;
        }
    </style>
@endsection
