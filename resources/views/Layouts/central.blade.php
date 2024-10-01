@include('includes.header_central')
<?php
    $active = \Illuminate\Support\Facades\Session::get('active');
?>
                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
                        <ul class="mainnav__menu nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link mininav-toggle {{ $active==1?'active':'' }}"><i class="demo-pli-home fs-5 me-2"></i>
                                    <span class="nav-label mininav-content ms-1">Tableau de bord</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('super.entreprises.index') }}" class="nav-link mininav-toggle {{ $active==2?'active':'' }}"><i class="pli-shop-2 fs-5 me-2"></i>
                                    <span class="nav-label mininav-content ms-1">Entreprises</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('super.users.index') }}" class="nav-link mininav-toggle {{ $active==3?'active':'' }}"><i class="pli-user fs-5 me-2"></i>
                                    <span class="nav-label mininav-content ms-1">Utilisateurs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END : Navigation Category -->
                </div>
                <!-- End - Navigation menu -->


                <style>
                    .btn.nav-link i{
                        color: white !important;
                    }
                </style>

@include('includes.footer')


