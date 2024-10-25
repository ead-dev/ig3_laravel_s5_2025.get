@extends('Layouts.admin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Précommandes</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des précommandes</li>
    </ol>
 </nav>
@endsection



@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Prévisions </h5>
        <p class="lead">Liste de toutes les prévisions de matiere de disponibilité de la feve  </p>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.css') }}">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4">
                <div class="w-md-160px w-xl-200px flex-shrink-0 mb-3">
                
                </div>
                <!-- Full calendar container -->
                <div class="flex-fill">
                    <div id="_dm-calendar"></div>
                 </div>
                 <!-- END : Full calendar container -->
            </div>
        </div>
    </div>
       <!-- Fullcalendar Scripts [ OPTIONAL ] -->
   <script src="{{ asset('assets/vendors/fullcalendar/index.global.min.js') }}"></script>
   <!-- Fullcalendar Scripts [ OPTIONAL ] -->
   <script type="module" src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.11/index.global.min.js"></script>


   <!-- Initialize [ SAMPLE ] -->
   <script src="{{ asset('assets/pages/fullcalendar.js') }}"></script>
@endsection
