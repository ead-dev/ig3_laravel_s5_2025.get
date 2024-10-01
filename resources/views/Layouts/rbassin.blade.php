@extends('Layouts.app')
@section('top')
<?php
$bassin = \Illuminate\Support\Facades\Session::get('bassin');
?>
<div class="d-flex gap-3">
    <div>
        <span><span class="badge bg-white text-dark fs-6">{{ $bassin->name }}</span> </span>
    </div>
    <div>
        <span>Connecté  en tant que :</span>
        <strong><span class="badge bg-white text-dark fs-6">Coordonnateur de bassin</span></strong>
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
           <a href="{{ route('rbassin.dashboard') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
               <span class="nav-label mininav-content ms-1">Tableau de board</span>
           </a>
       </li>

       <li class="nav-item">
           <a href="{{ route('rbassin.livraisons.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-sync fs-4 me-2"></i>
               <span class="nav-label mininav-content ms-1">Transactions</span>
           </a>
       </li>


          <!-- Link with submenu -->
          <li class="nav-item has-sub">
           <a href="#" class="mininav-toggle nav-link {{ ($active>200&&$active<300)?'active':'' }}"><i class="d-block pli-file-edit fs-5 me-2"></i>
               <span class="nav-label ms-1">Contrats</span>
           </a>
           <!-- Settings submenu list -->
           <ul class="mininav-content nav collapse">
               <li class="nav-item">
                   <a href="{{ route('rbassin.contrats.index') }}" class="nav-link {{ $active==201?'active':'' }}">Acheteurs</a>
               </li>
               <li class="nav-item">
                   <a href="{{ route('rbassin.protocoles.index') }}" class="nav-link {{ $active==202?'active':'' }}">Producteurs</a>
               </li>

           </ul>
           <!-- END : Dashboard submenu list -->
       </li>
       <!-- END : Link with submenu -->

          <!-- Link with submenu -->
          <li class="nav-item has-sub">
            <a href="#" class="mininav-toggle nav-link {{ ($active>300&&$active<400)?'active':'' }}"><i class="d-block demo-pli-add-user-star fs-5 me-2"></i>
                <span class="nav-label ms-1">Tiers</span>
            </a>
            <!-- Settings submenu list -->
            <ul class="mininav-content nav collapse">
                <li class="nav-item">
                    <a href="{{ route('rbassin.cooperatives.index') }}" class="nav-link {{ $active==302?'active':'' }}">Cooperatives</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rbassin.clients.index') }}" class="nav-link {{ $active==303?'active':'' }}">Acheteurs</a>
                </li>

            </ul>
            <!-- END : Dashboard submenu list -->
        </li>
        <!-- END : Link with submenu -->
       <!-- Link with submenu -->
       <li class="nav-item has-sub">
           <a href="#" class="mininav-toggle nav-link {{ ($active>400&&$active<500)?'active':'' }}"><i class="d-block pli-map fs-5 me-2"></i>
               <span class="nav-label ms-1">Territoire</span>
           </a>
           <!-- Settings submenu list -->
           <ul class="mininav-content nav collapse">
               <li class="nav-item">
                   <a href="{{ route('rbassin.villages.index') }}" class="nav-link {{ $active==401?'active':'' }}">Villages</a>
               </li>
               <li class="nav-item">
                   <a href="{{ route('rbassin.arrondissements.index') }}" class="nav-link {{ $active==402?'active':'' }}">Arrondissements</a>
               </li>

           </ul>
           <!-- END : Dashboard submenu list -->
       </li>
       <!-- END : Link with submenu -->
        <!-- Link with submenu -->
       <li class="nav-item has-sub">
           <a href="#" class="mininav-toggle nav-link {{ ($active>500&&$active<600)?'active':'' }}"><i class="d-block pli-files fs-5 me-2"></i>
               <span class="nav-label ms-1">Archives</span>
           </a>
           <!-- Settings submenu list -->
           <ul class="mininav-content nav collapse">
               <li class="nav-item">
                   <a href="{{ route('rbassin.archives.transactions') }}" class="nav-link {{ $active==501?'active':'' }}">Transactions</a>
               </li>

           </ul>
           <!-- END : Dashboard submenu list -->
       </li>
       <!-- END : Link with submenu -->
    </ul>
</div>
<!-- END : Navigation Category -->
@endsection