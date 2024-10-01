@include('includes.header')
<?php
    $active = \Illuminate\Support\Facades\Session::get('active');
?>
     <!-- Navigation Category -->
     <div class="mainnav__categoriy py-3">
         <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
         <ul class="mainnav__menu nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Tableau de board</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.livraisons.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-sync fs-5 me-2"></i>
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
                        <a href="{{ route('admin.contrats.index') }}" class="nav-link {{ $active==201?'active':'' }}">Acheteurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.protocoles.index') }}" class="nav-link {{ $active==202?'active':'' }}">Producteurs</a>
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
                         <a href="{{ route('admin.banks.index') }}" class="nav-link {{ $active==301?'active':'' }}">Banques</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.cooperatives.index') }}" class="nav-link {{ $active==302?'active':'' }}">Cooperatives</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.clients.index') }}" class="nav-link {{ $active==303?'active':'' }}">Acheteurs</a>
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
                        <a href="{{ route('admin.villages.index') }}" class="nav-link {{ $active==401?'active':'' }}">Villages</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.arrondissements.index') }}" class="nav-link {{ $active==402?'active':'' }}">Arrondissements</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.departements.index') }}" class="nav-link {{ $active==403?'active':'' }}">Departements</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.regions.index') }}" class="nav-link {{ $active==404?'active':'' }}">Regions</a>
                    </li>

                </ul>
                <!-- END : Dashboard submenu list -->
            </li>
            <!-- END : Link with submenu -->

             <!-- Link with submenu -->
             <li class="nav-item has-sub">
                 <a href="#" class="mininav-toggle nav-link {{ ($active>700&&$active<800)?'active':'' }}"><i class="demo-pli-gears fs-5 me-2"></i>
                     <span class="nav-label ms-1">Parametres</span>
                 </a>
                 <!-- Settings submenu list -->
                 <ul class="mininav-content nav collapse">

                    <li class="nav-item">
                        <a href="{{ route('admin.saisons.index') }}" class="nav-link {{ $active==701?'active':'' }}">Saisons</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.operateurs.index') }}" class="nav-link {{ $active==702?'active':'' }}">Operateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.rbassins.index') }}" class="nav-link {{ $active==703?'active':'' }}">Points focaux</a>
                    </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.pays.index') }}" class="nav-link {{ $active==704?'active':'' }}">Pays</a>
                     </li>
                 </ul>
                 <!-- END : Dashboard submenu list -->
             </li>
             <!-- END : Link with submenu -->

         </ul>
     </div>
     <!-- END : Navigation Category -->
 </div>
 <!-- End - Navigation menu -->

@include('includes.footer')
