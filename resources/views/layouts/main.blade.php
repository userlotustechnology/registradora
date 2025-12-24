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
    
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard-custom.css') }}">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    
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

    <!-- Start Sidebar Area -->
    <div class="sidebar-area" id="sidebar-area">
        <div class="logo position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="d-block text-decoration-none position-relative">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo-icon">
                <span class="logo-text text-secondary fw-semibold">NPO</span>
            </a> 
            <button class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu-close">
                <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(45deg);"></span>
                <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(-45deg);"></span>
            </button>
            <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
                <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
            </button>
        </div>

        <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
            <ul class="menu-inner">
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">PRINCIPAL</span>
                </li>
                
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'open' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">dashboard</span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->role === 'admin')
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">ADMINISTRAÇÃO</span>
                </li>
                
                <li class="menu-item {{ request()->routeIs('users.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">person</span>
                        <span class="title">Usuários</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                Listar Usuários
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link {{ request()->routeIs('users.create') ? 'active' : '' }}">
                                Adicionar Usuário
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.partners.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">business</span>
                        <span class="title">Parceiros</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.partners.index') }}" class="menu-link {{ request()->routeIs('admin.partners.index') ? 'active' : '' }}">
                                Listar Parceiros
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.partners.create') }}" class="menu-link {{ request()->routeIs('admin.partners.create') ? 'active' : '' }}">
                                Adicionar Parceiro
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.end-customers.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('admin.end-customers.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">people</span>
                        <span class="title">Clientes Finais</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.end-customers.index') }}" class="menu-link {{ request()->routeIs('admin.end-customers.index') ? 'active' : '' }}">
                                Listar Clientes
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.end-customers.create') }}" class="menu-link {{ request()->routeIs('admin.end-customers.create') ? 'active' : '' }}">
                                Adicionar Cliente
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.value-records.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('admin.value-records.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">receipt_long</span>
                        <span class="title">Registros de Valores</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.value-records.index') }}" class="menu-link {{ request()->routeIs('admin.value-records.index') ? 'active' : '' }}">
                                Listar Registros
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.value-records.create') }}" class="menu-link {{ request()->routeIs('admin.value-records.create') ? 'active' : '' }}">
                                Adicionar Registro
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('paroquia.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('paroquia.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">church</span>
                        <span class="title">Paróquia</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Informações
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.settings.index') }}" class="menu-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                                Configurações
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">COMUNIDADE</span>
                </li>

                <li class="menu-item {{ request()->routeIs('eventos.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('eventos.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">event</span>
                        <span class="title">Eventos</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Próximos Eventos
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Calendário
                            </a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Criar Evento
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('comunidade.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('comunidade.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">group</span>
                        <span class="title">Comunidade</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Membros
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Grupos
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Ministérios
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('comunicacao.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('comunicacao.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">chat</span>
                        <span class="title">Comunicação</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Avisos
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Notícias
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Boletim
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">FINANCEIRO</span>
                </li>

                <li class="menu-item {{ request()->routeIs('financeiro.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->routeIs('financeiro.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">payments</span>
                        <span class="title">Financeiro</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Dízimos
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Ofertas
                            </a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Relatórios
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">CONTA</span>
                </li>

                <li class="menu-item {{ request()->routeIs('perfil.*') ? 'open' : '' }}">
                    <a href="#" class="menu-link {{ request()->routeIs('perfil.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">account_circle</span>
                        <span class="title">Meu Perfil</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="material-symbols-outlined menu-icon">settings</span>
                        <span class="title">Configurações</span>
                    </a>
                </li>

                <li class="menu-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="menu-link bg-transparent border-0 w-100 text-start">
                            <span class="material-symbols-outlined menu-icon">logout</span>
                            <span class="title">Sair</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
    </div>
    <!-- End Sidebar Area -->

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">
        <!-- Start Header Area -->
            <header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-header-content">
                            <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                                <li class="d-xl-none">
                                    <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3" id="header-burger-menu">
                        <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                        <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                        <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                    </button>
                                </li>
                                <li>
                                    <form class="src-form position-relative">
                                        <input type="text" class="form-control" placeholder="Pesquisar aqui...">
                                        <div class="src-btn position-absolute top-50 start-0 translate-middle-y bg-transparent p-0 border-0">
                                            <span class="material-symbols-outlined">search</span>
                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="right-header-content mt-3 mt-md-0">
                            <ul class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">
                                <li class="header-right-item light-dark-item">
                                    <div class="light-dark">
                                        <button class="switch-toggle dark-btn p-0 bg-transparent lh-0 border-0" id="switch-toggle">
                                            <span class="dark"><i class="material-symbols-outlined">dark_mode</i></span> 
                                            <span class="light"><i class="material-symbols-outlined">light_mode</i></span>
                                        </button>
                                    </div>
                                </li>
                                <li class="header-right-item">
                                    <div class="dropdown notifications noti">
                                        <button class="btn btn-secondary border-0 p-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="material-symbols-outlined">notifications</span>
                                            <span class="count">3</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-lg p-0 border-0 p-0 dropdown-menu-end">
                                            <div class="d-flex justify-content-between align-items-center title">
                                                <span class="fw-medium fs-16 text-secondary">Notificações <span class="fw-normal text-body fs-16">(03)</span></span>
                                                <button class="p-0 m-0 bg-transparent border-0 fs-15 text-primary fw-medium">Limpar Todas</button>
                                            </div> 

                                            <div style="max-height: 300px;" data-simplebar>
                                                <div class="notification-menu unseen">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-symbols-outlined text-primary">sms</i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <p class="fs-16 fw-medium text-secondary">Você tem uma nova mensagem</p>
                                                                <span class="fs-14 fw-medium">2 hrs atrás</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu unseen">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-symbols-outlined text-info">person</i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <p class="fs-16 fw-medium text-secondary">Novo membro adicionado</p>
                                                                <span class="fs-14 fw-medium">3 hrs atrás</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="notification-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-symbols-outlined text-success">mark_email_unread</i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <p class="fs-16 fw-medium text-secondary">Evento próximo</p>
                                                                <span class="fs-14 fw-medium">1 dia atrás</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <a href="#" class="dropdown-item text-center text-primary d-block view-all fw-medium rounded-bottom-3">
                                                <span>Ver Todas as Notificações</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0 position-relative">
                                                <img class="rounded-circle admin-img-width-for-mobile" style="width: 40px; height: 40px;" src="{{ asset('assets/images/admin.png') }}" alt="admin">
                                                <span class="d-block bg-success-60 border border-2 border-white rounded-circle position-absolute end-0 bottom-0" style="width: 11px; height: 11px;"></span>
                                            </div>
                                        </div>
        
                                        <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                            <div class="d-flex align-items-center info">
                                                <div class="flex-shrink-0">
                                                    <img class="rounded-circle admin-img-width-for-mobile" style="width: 40px; height: 40px;" src="{{ asset('assets/images/admin.png') }}" alt="admin">
                                                </div>
                                                <div class="flex-grow-1 ms-10">
                                                    <h3 class="fw-medium fs-17 mb-0">{{ Auth::user()->name }}</h3>
                                                    <span class="fs-15 fw-medium">{{ ucfirst(Auth::user()->role) }}</span>
                                </div>
                                </div>
                                            <ul class="admin-link mb-0 list-unstyled">
                                                <li>
                                                    <a class="dropdown-item admin-item-link d-flex align-items-center text-body" href="#">
                                                        <i class="material-symbols-outlined">person</i>
                                                        <span class="ms-2">Meu Perfil</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item admin-item-link d-flex align-items-center text-body" href="#">
                                                        <i class="material-symbols-outlined">settings</i>
                                                        <span class="ms-2">Configurações</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item admin-item-link d-flex align-items-center text-body" href="#">
                                                        <i class="material-symbols-outlined">info</i>
                                                        <span class="ms-2">Suporte</span>
                                                    </a>
                                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                                        <button type="submit" class="dropdown-item admin-item-link d-flex align-items-center text-body w-100 bg-transparent border-0">
                                                            <i class="material-symbols-outlined">logout</i>
                                                            <span class="ms-2">Sair</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                                    </div>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header Area -->

            <div class="main-content-container overflow-hidden">
            @yield('content')
            </div>

            <div class="flex-grow-1"></div>

            <!-- Start Footer Area -->
            <footer class="footer-area bg-white text-center rounded-10 rounded-bottom-0">
                <p class="fs-16 text-body">© <span class="text-secondary">Registradora de Valores</span> - Sistema de Gestão Paroquial</p>
            </footer>
            <!-- End Footer Area -->
        </div>
    </div>
    <!-- End Main Content Area -->

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
    <script src="{{ asset('assets/js/sidebar-menu-simple.js') }}"></script>
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
    
    <!-- Custom Dashboard JavaScript -->
    <script src="{{ asset('js/dashboard-custom.js') }}"></script>

    <!-- Link Of JS File -->
    
    <!-- Custom JavaScript for Dashboard -->

    @yield('scripts')
