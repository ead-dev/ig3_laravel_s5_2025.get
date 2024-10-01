<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Keep your header fixed at the top of pages.">
    <title>ZANZI CASHER</title>

    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--- -->

    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('assets/css/nifty.min.css') }}">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo-purpose/demo-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/premium/icon-sets/icons/solid-icons/premium-solid-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/premium/icon-sets/icons/solid-icons/premium-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-group{
            margin-top: 1rem;
        }
    </style>
</head>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--sticky hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            @yield('page-header')

            @yield('content')
            <div style="min-height:540px;" class="page__bottom bg-primary">

            </div>
            <!-- FOOTER -->
            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; {{ date('Y') }} <a href="#" class="ms-1 btn-link fw-bold">CLegal</a></div>
                        <nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto" style="row-gap: 0 !important;">
                            <a class="nav-link px-0" href="#">Contact</a>
                        </nav>
                    </div>
                </div>
            </footer>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <header class="header">
            <div class="header__inner">
                <!-- Brand -->
                <div class="header__brand">
                    <div class="brand-wrap">
                        <!-- Brand logo -->
                        <a href="{{ route('frontend.pages.index') }}" class="brand-img stretched-link">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="Nifty logo" width="40" height="40">
                        </a>

                        <!-- Brand title -->
                        <div class="brand-title">ZANZI CASHER</div>

                        <!-- You can also use IMG or SVG instead of a text element. -->

                    </div>
                </div>
                <!-- End - Brand -->

                <div class="header__content">

                    <!-- Content Header - Left Side: -->
                    <div class="header__content-start">
                        <!-- Searchbox -->
                        <div class="header-searchbox">

                            <!-- Searchbox toggler for small devices -->
                            <label for="header-search-input" class="header__btn d-md-none btn btn-icon rounded-pill shadow-none border-0 btn-sm" type="button">
                                <i class="demo-psi-magnifi-glass"></i>
                            </label>

                            <!-- Searchbox input -->
                            <form class="searchbox searchbox--auto-expand searchbox--hide-btn input-group">
                                <input id="header-search-input" class="searchbox__input form-control bg-transparent" type="search" placeholder="Rechercher ..." aria-label="Search">
                                <div class="searchbox__backdrop">
                                    <button class="searchbox__btn header__btn btn btn-icon rounded shadow-none border-0 btn-sm" type="button" id="button-addon2">
                                        <i class="demo-pli-magnifi-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End - Content Header - Left Side -->

                    <!-- Content Header - Right Side: -->
                    <div class="header__content-end">
                        <div>
                            <a class="btn btn-danger" href="tel:+242064576186"><i class="psi-telephone"></i>+242 06 457 61 86</a>
                            <a class="btn btn-outline btn-outline-danger" href="mailto:clementessomba@gmail.com"><i class="psi-email"></i> Ecrivez nous</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->



    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    <!-- SCROLL TO TOP BUTTON -->
    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->
    <style>
        nav .nav-link{
            color: #ffffff;
            font-size: 0.89rem;

        }
        nav .nav-link:active,nav .nav-link:hover,nav .nav-link:focus,.nav-link.active{
            color: #df5645;
            font-size: 1rem;

        }
    </style>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - OFFCANVAS [ DEMO ] -->

    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="{{ asset('assets/vendors/popperjs/popper.min.js') }}" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script defer>
        $('#navbarDropdownMenuLink2').click(function(){
            $('.dropdown-menu.show').css({
                'position': 'absolute',
                'inset': '0px auto auto 0px',
                'margin': '1px',
                'transform': 'translate3d(-50%, 35px, 200px)'
            })
        })
    </script>

    @yield('scripts')



</body>

</html>
