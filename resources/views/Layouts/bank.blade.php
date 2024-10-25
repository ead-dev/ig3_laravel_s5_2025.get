@extends('Layouts.app')
@section('top')
<?php
$banque = \Illuminate\Support\Facades\Session::get('banque');
?>
<div class="d-flex gap-3">
    <div>
        <span><span class="badge bg-white text-dark fs-6">{{ $banque->name }}</span> </span>
    </div>
    <div>
        <span>Connecté  en tant que :</span>
        <strong><span class="badge bg-white text-dark fs-6">Banquier</span></strong>
    </div>
</div>
@endsection
@section('navigation')
 <!-- Navigation Category -->
 <?php
    $active = \Illuminate\Support\Facades\Session::get('active');
?>
 <div class="mainnav__categoriy py-3">
    <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
    <ul class="mainnav__menu nav flex-column">
        <li class="nav-item">
            <a href="{{ route('bank.dashboard') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
                <span class="nav-label mininav-content ms-1">Tableau de board</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('bank.paiements.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-coins fs-5 me-2"></i>
                <span class="nav-label mininav-content ms-1">Paiements</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('bank.invoices.index') }}" class="nav-link mininav-toggle {{ $active==3?'active':'' }}"><i class="pli-files fs-5 me-2"></i>
                <span class="nav-label mininav-content ms-1">Offres commerciales</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('bank.contrats.index') }}" class="nav-link mininav-toggle {{ $active==4?'active':'' }}"><i class="d-block pli-file-edit fs-5 me-2"></i>
                <span class="nav-label mininav-content ms-1">Contrats Acheteurs</span>
            </a>
        </li>

    </ul>
</div>
<!-- END : Navigation Category -->
@endsection