@include('includes.header')
<?php
    $active = \Illuminate\Support\Facades\Session::get('active');
?>
     <!-- Navigation Category -->
     <div class="mainnav__categoriy py-3">
         <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
         <ul class="mainnav__menu nav flex-column">
            <li class="nav-item">
                <a href="{{ route('client.dashboard') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Tableau de board</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('client.precommandes.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-file fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Commandes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('client.invoices.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-file-copy-2 fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Offres commerciales</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('client.contrats.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="d-block pli-file-edit fs-5 me-2"></i>
                    <span class="nav-label mininav-content ms-1">Contrats</span>
                </a>
            </li>

         </ul>
     </div>
     <!-- END : Navigation Category -->
 </div>
 <!-- End - Navigation menu -->

@include('includes.footer')
