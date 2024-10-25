@include('includes.header')
<?php
    $active = \Illuminate\Support\Facades\Session::get('active');
?>
     <!-- Navigation Category -->
     <div class="mainnav__categoriy py-3">
         <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
         <ul class="mainnav__menu nav flex-column">
            <li class="nav-item">
                <a href="{{ route('cooperative.dashboard') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Tableau de board</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cooperative.paiements.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-coins fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Reglements Banque</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cooperative.invoices.index') }}" class="nav-link mininav-toggle {{ $active==3?'active':'' }}"><i class="pli-handshake fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Ventes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cooperative.members.index') }}" class="nav-link mininav-toggle {{ $active==4?'active':'' }}"><i class="pli-conference fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Adherents</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cooperative.protocoles.index') }}" class="nav-link mininav-toggle {{ $active==5?'active':'' }}"><i class="d-block pli-file-edit fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Contrats</span>
                </a>
            </li>

         </ul>
     </div>
     <!-- END : Navigation Category -->
 </div>
 <!-- End - Navigation menu -->

@include('includes.footer')
