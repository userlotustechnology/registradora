@extends('layouts.main')

@section('title', 'Dashboard - Nossa Paroquia Online')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4 py-50">
    <div class="row">
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10">Novos Membros</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">{{ $stats['new_members'] ?? 25 }}</h2>
                    </div>
                    <div class="flex-shrink-0" style="margin-bottom: -25px;">
                        <div id="new_members_chart" class="chart-position"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-success bg-opacity-10 border border-success" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-success">trending_up</i>
                        <span class="lh-1 fs-14 text-success">12.5%</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Esta Semana</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10">Membros Ativos</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">{{ $stats['active_members'] ?? 450 }}</h2>
                    </div>
                    <div class="flex-shrink-0" style="margin-bottom: -25px;">
                        <div id="active_members_chart" class="chart-position"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-success bg-opacity-10 border border-success" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-success">trending_up</i>
                        <span class="lh-1 fs-14 text-success">8.75%</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Este Mês</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10">Eventos Ativos</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">{{ $stats['active_events'] ?? 8 }}</h2>
                    </div>
                    <div class="flex-shrink-0" style="margin-bottom: -25px;">
                        <div id="events_chart" class="chart-position"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-warning bg-opacity-10 border border-warning" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-warning">trending_flat</i>
                        <span class="lh-1 fs-14 text-warning">0.5%</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Última Semana</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10">Doações Mês</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">R$ {{ number_format($stats['monthly_donations'] ?? 15750, 2, ',', '.') }}</h2>
                    </div>
                    <div class="flex-shrink-0" style="margin-bottom: -25px;">
                        <div id="donations_chart" class="chart-position" style="bottom: -8px;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-success bg-opacity-10 border border-success" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-success">trending_up</i>
                        <span class="lh-1 fs-14 text-success">18.5%</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Crescimento Mensal</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-4 col-xxxl-6">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3>Participação por Ministério</h3>

                <div class="dropdown select-dropdown without-border">
                    <button class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                        Este Mês
                    </button>
                
                    <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                        <li>
                            <button class="dropdown-item text-secondary">Este Dia</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Esta Semana</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Mês</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Ano</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center">
                <div id="ministries_chart" style="max-width: 305px; margin: auto;"></div>
            </div>

            <ul class="p-0 mb-0 list-unstyled last-child-none icon-bg">
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center">
                        <div class="text-center rounded-circle" style="width: 50px; height: 50px; background-color: #f4f6fc;">
                            <i class="material-symbols-outlined fs-24 text-primary position-relative" style="line-height: 50px; left: -2px;">music_note</i>
                        </div>
                        <span class="ms-12 fs-16 text-secondary fw-medium">Coral</span>
                    </div>
                    <span class="fs-16">45</span>
                    <span class="fs-16">35%</span>
                </li>
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center">
                        <div class="text-center rounded-circle" style="width: 50px; height: 50px; background-color: #f4f6fc;">
                            <i class="material-symbols-outlined fs-24 text-info" style="line-height: 50px;">volunteer_activism</i>
                        </div>
                        <span class="ms-12 fs-16 text-secondary fw-medium">Pastoral</span>
                    </div>
                    <span class="fs-16">32</span>
                    <span class="fs-16">25%</span>
                </li>
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center">
                        <div class="text-center rounded-circle" style="width: 50px; height: 50px; background-color: #f4f6fc;">
                            <i class="material-symbols-outlined fs-24 text-primary-50" style="line-height: 50px;">child_care</i>
                        </div>
                        <span class="ms-12 fs-16 text-secondary fw-medium">Catequese</span>
                    </div>
                    <span class="fs-16">28</span>
                    <span class="fs-16">22%</span>
                </li>
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center">
                        <div class="text-center rounded-circle" style="width: 50px; height: 50px; background-color: #f4f6fc;">
                            <i class="material-symbols-outlined fs-24 text-warning" style="line-height: 50px;">diversity_3</i>
                        </div>
                        <span class="ms-12 fs-16 text-secondary fw-medium">Outros</span>
                    </div>
                    <span class="fs-16">23</span>
                    <span class="fs-16">18%</span>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="col-xxl-4 col-xxxl-6">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3>Frequência por Faixa Etária</h3>

                <div class="dropdown select-dropdown without-border">
                    <button class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                        Este Mês
                    </button>
                
                    <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                        <li>
                            <button class="dropdown-item text-secondary">Este Dia</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Esta Semana</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Mês</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Ano</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center mb-3">
                <div id="age_groups_chart" style="height: 284px;"></div>
            </div>

            <div class="default-table-area mx-minus-1 country-stats-table">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-transparent py-0 ps-0">Faixa Etária</th>
                                <th scope="col" class="bg-transparent py-0">Membros</th>
                                <th scope="col" class="bg-transparent py-0 pe-0">Frequência</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-primary">child_care</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h3 class="fw-medium mb-0 fs-16 position-relative top-2">0-12 anos</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body fw-normal">85</td>
                                <td class="text-body fw-normal pe-0">92%</td> 
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-info">school</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h3 class="fw-medium mb-0 fs-16 position-relative top-2">13-17 anos</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body fw-normal">67</td>
                                <td class="text-body fw-normal pe-0">78%</td> 
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-warning">group</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h3 class="fw-medium mb-0 fs-16 position-relative top-2">18-64 anos</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body fw-normal">245</td>
                                <td class="text-body fw-normal pe-0">85%</td> 
                            </tr>
                            <tr class="last-child-border-none">
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-success">elderly</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h3 class="fw-medium mb-0 fs-16 position-relative top-2">65+ anos</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body fw-normal">53</td>
                                <td class="text-body fw-normal pe-0">95%</td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-4 col-xxxl-12">
        <div class="row">
            <div class="col-xxxl-6 col-xxl-12">
                <div class="card p-20 rounded-10 border border-white mb-4" style="background: linear-gradient(180deg, #5c4edb, #796df6) !important;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-0">
                        <h3 class="text-white">Atividades da Semana</h3>

                        <div class="dropdown select-dropdown without-border">
                            <button class="dropdown-toggle down-arrow-white bg-transparent text-white fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                                Semana Atual
                            </button>
                        
                            <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                                <li>
                                    <button class="dropdown-item text-secondary">Semana Atual</button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-secondary">Próxima Semana</button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-secondary">Última Semana</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="weekly_activities_chart" style="margin-bottom: -17px;"></div>
                </div>
            </div>
            <div class="col-xxxl-6 col-xxl-12">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-0">
                        <h3>Relatório Financeiro</h3>

                        <div class="dropdown select-dropdown">
                            <button class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                                Esta Semana
                            </button>
                        
                            <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                                <li>
                                    <button class="dropdown-item text-secondary">Este Dia</button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-secondary">Esta Semana</button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-secondary">Este Mês</button>
                                </li>
                                <li>
                                    <button class="dropdown-item text-secondary">Este Ano</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="financial_chart" style="margin-bottom: -17px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3>Membros Mais Ativos</h3>

                <div class="dropdown select-dropdown without-border">
                    <button class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                        Esta Semana
                    </button>
                
                    <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                        <li>
                            <button class="dropdown-item text-secondary">Este Dia</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Esta Semana</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Mês</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Ano</button>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="default-table-area without-header table-top-customers">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <tbody>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user6.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user6">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">Maria Silva</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2018</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td> 
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user7.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user7">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">João Santos</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2019</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td> 
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user8.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user8">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">Ana Costa</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2020</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user9.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user9">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">Pedro Oliveira</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2017</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user10.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user10">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">Lucia Ferreira</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2021</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td> 
                            </tr>
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center text-decoration-none">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user11.jpg') }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="user11">
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-normal">Carlos Mendes</h3>
                                            <span class="fs-14 text-body fw-normal">Membro desde 2016</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <a href="#" class="text-body hover-text text-decoration-none fw-normal">Ver Perfil</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap pt-15">
                    <span class="fs-15">Mostrando 1 de 6 de 50 entradas</span>

                    <nav class="custom-pagination" aria-label="Page navigation example">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item">
                                <button class="page-link icon" aria-label="Previous">
                                    <i class="material-symbols-outlined">west</i>
                                </button>
                            </li>
                            <li class="page-item">
                                <button class="page-link icon" aria-label="Next">
                                    <i class="material-symbols-outlined">east</i>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
                <h3>Próximos Eventos</h3>

                <div class="dropdown select-dropdown without-border">
                    <button class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown" aria-expanded="false">
                        Esta Semana
                    </button>
                
                    <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar>
                        <li>
                            <button class="dropdown-item text-secondary">Este Dia</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Esta Semana</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Mês</button>
                        </li>
                        <li>
                            <button class="dropdown-item text-secondary">Este Ano</button>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="default-table-area mx-minus-1 table-recent-leads">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-medium">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault14">
                                    </div>
                                </th>
                                <th scope="col" class="fw-medium">Evento</th>
                                <th scope="col" class="fw-medium">Data</th>
                                <th scope="col" class="fw-medium">Local</th>
                                <th scope="col" class="fw-medium">Status</th>
                                <th scope="col" class="fw-medium">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-body" style="width: 62px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault2">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-primary">event</i>
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-medium mb-0 fs-16">Missa Dominical</h3>
                                        </div>
                                    </div>
                                </td>  
                                <td class="text-body">26/09/2025</td> 
                                <td class="text-body">Igreja Principal</td> 
                                <td>
                                    <span class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">Confirmado</span>
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">visibility</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Event">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">edit</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">delete</i>
                                        </button>
                                    </div>
                                </td> 
                            </tr>
                            <tr>
                                <td class="text-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault3">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-info">school</i>
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-medium mb-0 fs-16">Catequese Infantil</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body">28/09/2025</td> 
                                <td class="text-body">Sala de Catequese</td> 
                                <td>
                                    <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">Planejado</span>
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">visibility</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Event">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">edit</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">delete</i>
                                        </button>
                                    </div>
                                </td> 
                            </tr>
                            <tr>
                                <td class="text-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault4">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-warning">music_note</i>
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-medium mb-0 fs-16">Ensaio do Coral</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body">30/09/2025</td> 
                                <td class="text-body">Salão Paroquial</td> 
                                <td>
                                    <span class="text-warning bg-warning bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">Em Andamento</span>
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">visibility</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Event">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">edit</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">delete</i>
                                        </button>
                                    </div>
                                </td> 
                            </tr>
                            <tr>
                                <td class="text-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault5">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-danger">volunteer_activism</i>
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-medium mb-0 fs-16">Ação Social</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body">02/10/2025</td> 
                                <td class="text-body">Comunidade</td> 
                                <td>
                                    <span class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">Cancelado</span>
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">visibility</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Event">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">edit</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">delete</i>
                                        </button>
                                    </div>
                                </td> 
                            </tr>
                            <tr>
                                <td class="text-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault6">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined text-success">celebration</i>
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h3 class="fw-medium mb-0 fs-16">Festa Junina</h3>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-body">05/10/2025</td> 
                                <td class="text-body">Pátio da Igreja</td> 
                                <td>
                                    <span class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">Confirmado</span>
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">visibility</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Event">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">edit</i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">delete</i>
                                        </button>
                                    </div>
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap pt-15 p-20">
                    <span class="fs-15">Mostrando 1 de 5 de 20 entradas</span>

                    <nav class="custom-pagination" aria-label="Page navigation example">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item">
                                <button class="page-link icon" aria-label="Previous">
                                    <i class="material-symbols-outlined">west</i>
                                </button>
                            </li>
                            <li class="page-item">
                                <button class="page-link active">1</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link">2</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link">3</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link icon" aria-label="Next">
                                    <i class="material-symbols-outlined">east</i>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize charts
    initializeCharts();
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function initializeCharts() {
    // New Members Chart
    if (typeof ApexCharts !== 'undefined') {
        // Mini chart for new members
        var newMembersOptions = {
            series: [{
                data: [15, 20, 18, 25, 22, 30, 25]
            }],
            chart: {
                type: 'line',
                width: 80,
                height: 35,
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
                colors: ['#28a745']
            },
            tooltip: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#new_members_chart"), newMembersOptions).render();
        
        // Active Members Chart
        var activeMembersOptions = {
            series: [{
                data: [400, 420, 435, 445, 450, 448, 450]
            }],
            chart: {
                type: 'line',
                width: 80,
                height: 35,
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
                colors: ['#007bff']
            },
            tooltip: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#active_members_chart"), activeMembersOptions).render();
        
        // Events Chart
        var eventsOptions = {
            series: [{
                data: [5, 8, 6, 9, 7, 8, 8]
            }],
            chart: {
                type: 'line',
                width: 80,
                height: 35,
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
                colors: ['#ffc107']
            },
            tooltip: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#events_chart"), eventsOptions).render();
        
        // Donations Chart
        var donationsOptions = {
            series: [{
                data: [12000, 13500, 14200, 15000, 14800, 15750, 15750]
            }],
            chart: {
                type: 'line',
                width: 80,
                height: 35,
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
                colors: ['#28a745']
            },
            tooltip: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#donations_chart"), donationsOptions).render();
        
        // Ministries Pie Chart
        var ministriesOptions = {
            series: [35, 25, 22, 18],
            chart: {
                type: 'pie',
                width: 305
            },
            labels: ['Coral', 'Pastoral', 'Catequese', 'Outros'],
            colors: ['#007bff', '#17a2b8', '#6f42c1', '#ffc107'],
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#ministries_chart"), ministriesOptions).render();
        
        // Weekly Activities Chart
        var weeklyActivitiesOptions = {
            series: [{
                name: 'Atividades',
                data: [2, 4, 3, 5, 6, 4, 3]
            }],
            chart: {
                type: 'area',
                height: 180,
                toolbar: {
                    show: false
                }
            },
            colors: ['#ffffff'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            stroke: {
                width: 2,
                colors: ['#ffffff']
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                labels: {
                    style: {
                        colors: '#ffffff'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#ffffff'
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#weekly_activities_chart"), weeklyActivitiesOptions).render();
        
        // Financial Chart
        var financialOptions = {
            series: [{
                name: 'Entradas',
                data: [3000, 4000, 3500, 5000, 4200, 4800, 5200]
            }, {
                name: 'Saídas',
                data: [2000, 2500, 2200, 3000, 2800, 3200, 3500]
            }],
            chart: {
                type: 'area',
                height: 180,
                toolbar: {
                    show: false
                }
            },
            colors: ['#28a745', '#dc3545'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            stroke: {
                width: 2
            },
            grid: {
                borderColor: '#e9ecef'
            },
            xaxis: {
                categories: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7']
            },
            legend: {
                position: 'top'
            }
        };
        new ApexCharts(document.querySelector("#financial_chart"), financialOptions).render();
    }
    
    // Age Groups Chart with JSVectorMap or similar
    if (typeof jsVectorMap !== 'undefined') {
        // This would be for a map-like visualization
        // For now, we'll use a simple bar chart representation
    }
}
</script>
@endsection