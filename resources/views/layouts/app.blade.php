<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    
    <!-- Title -->
    <title>@yield('title', 'Registradora de Valores')</title>
</head>
<body class="bg-body-bg">
    
    <!-- Start Preloader Area -->
    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">N</span>
                <span class="d-inline-block">P</span>
                <span class="d-inline-block">O</span>
            </div>
        </div>
    </div>
    <!-- End Preloader Area -->

    @yield('content')

    <button class="switch-toggle dark-btn p-0 bg-transparent lh-0 border-0" id="switch-toggle"></button>

    <!-- Start Theme Setting Area -->
    <button class="btn btn-primary theme-settings-btn p-0 position-fixed z-2 text-center rounded-circle" style="bottom: 24px; right: 24px; width: 56px; height: 56px; line-height: 54px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i class="text-white ri-settings-3-fill fs-28" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Click On Theme Settings"></i>
    </button>

    <!-- Start Theme Setting Area -->
    <div class="offcanvas offcanvas-end bg-white border-0" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="box-shadow: 0 4px 20px #2f8fe812 !important; max-width: 300px;">
        <div class="offcanvas-header bg-light p-20">
            <h5 class="offcanvas-title fs-18 fw-medium" id="offcanvasScrollingLabel">Painel de Configuração</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            <div class="last-child-none" style="max-height: 858px;" data-simplebar>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Modo RTL</h4>
                    <div class="rtl-btn">
                        <label id="switch">
                            <input type="checkbox" onchange="toggleTheme()" class="toggle-switch rtl-switch" id="slider">
                        </label>
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Apenas Sidebar Escura</h4>
                    <div class="sidebar-light-dark" id="sidebar-light-dark">
                        <input type="checkbox" class="toggle-switch sidebar-dark-switch">
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Apenas Cabeçalho Escuro</h4>
                    <div class="header-light-dark" id="header-light-dark">
                        <input type="checkbox" class="toggle-switch header-dark-switch">
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Sidebar Direita</h4>
                    <div class="right-sidebar" id="right-sidebar">
                        <input type="checkbox" class="toggle-switch right-sidebar-switch">
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Ocultar Sidebar</h4>
                    <div class="icon-sidebar" id="icon-sidebar">
                        <input type="checkbox" class="toggle-switch icon-sidebar-switch">
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Card com Borda</h4>
                    <div class="card-border" id="card-border">
                        <input type="checkbox" class="toggle-switch border-switch">
                    </div>
                </div>
                <div class="p-20 border-bottom child">
                    <h4 class="fs-15 fw-medium mb-12">Raio da Borda do Card</h4>
                    <div class="card-radius-square" id="card-radius-square">
                        <input type="checkbox" class="toggle-switch border-radius-switch">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Theme Setting Area -->
 
    <!-- Link Of JS File -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.main.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/echarts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/maps.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>

    @yield('scripts')
</body>
</html>
