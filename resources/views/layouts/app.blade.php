<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Fonts -->
    <link id="pagestyle" href="{{ asset('assets/admin/css/bagas.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/admin/css/soft-ui-dashboardnew.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js.js') }}"></script>
    <!-- Font Awesome Icons -->
    <script src="{{ asset('assets/admin/js/fontawesomekit.js') }}"></script>
    @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-100">

    <main class="main-content position-relative h-100 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl shadow-none"
            id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">

                <a class="navbar-brand mx-3 bagashidemd" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="ms-md-auto pe-md-3 d-flex align-items-center bagas-search-xs">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type here...">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <ul class="navbar-nav  justify-content-end">


                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item bagashidemd">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item bagashidemd">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="">
                                    <a class="nav-link">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span
                                            class="badge badge-md badge-circle badge-floating bg-primary text-white">4</span>
                                    </a>
                                </li>
                                <li class="bagashidemd">
                                    <a class="nav-link">
                                        <i class="fas fa-heart"></i>
                                        <span
                                            class="badge badge-md badge-circle badge-floating bg-primary text-white">4</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown bagashidemd">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            <li class="nav-item d-md-none ps-3">
                                <a href="javascript:;" class="nav-link text-body px-0 h4">
                                    <i class="fas fa-bars fixed-plugin-button-nav cursor-pointer"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
       @yield('nav-menu')

        <div class="py-2">
            @yield('content')
        </div>
    </main>

    <div class="fixed-plugin">
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0  navbar-vertical">
                <!-- Sidebar Backgrounds -->

                <div class="menu">

                    @guest
                        @if (Route::has('login'))
                            <div class="item"> <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        @endif

                        @if (Route::has('register'))
                            <div class="item"> <a class="nav-link"
                                    href="{{ route('register') }}">{{ __('Register') }}</a></div>
                        @endif
                    @else
                        <div class="item"><a class="nav-link d-block">
                                <i class="fas fa-shopping-cart"></i>Keranjang
                                <span class="ct-docs-sidenav-pro-badge bg-primary text-white">4</span>
                            </a></div>

                        <div class="item"><a class="nav-link d-block">
                                <i class="fas fa-shopping-cart"></i>Wishlist
                                <span class="ct-docs-sidenav-pro-badge bg-primary text-white">4</span>
                            </a></div>

                        <div class="item">
                            <a class="sub-btn"><i class="fas fa-table"></i> {{ Auth::user()->name }}<i
                                    class="fas fa-angle-right dropdown"></i></a>
                            <div class="sub-menu border-radius-xl ">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit(); "class="sub-item">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        $('#dropdown-menu-btn').click(function() {
            $(this).next('.dropdown-menu-custom').slideToggle();
            $(this).find('.icon-dropdown').toggleClass('rotate');
        });
        $('.sub-btn').click(function() {
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.dropdown').toggleClass('rotate');
        });
    </script>
    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/admin/js/soft-ui-dashboard.js') }}"></script>
    @livewireScripts
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::scripts />
</body>

</html>
