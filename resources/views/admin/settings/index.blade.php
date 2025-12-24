@extends('layouts.main')

@section('title', 'Configurações - Admin')

@section('content')
<div class="container-fluid">
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Configurações do Sistema</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li><span>Admin</span></li>
                        <li><span>Configurações</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações da Paróquia</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nome da Paróquia</label>
                            <input type="text" class="form-control" value="Paróquia Nossa Senhora da Conceição">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <textarea class="form-control" rows="3">Rua das Flores, 123 - Centro</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" value="(11) 1234-5678">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="contato@paroquia.com">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Configurações do Sistema</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nome do Sistema</label>
                            <input type="text" class="form-control" value="Registradora de Valores">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Versão</label>
                            <input type="text" class="form-control" value="1.0.0" readonly>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="maintenance" checked>
                                <label class="form-check-label" for="maintenance">
                                    Modo de Manutenção
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="notifications" checked>
                                <label class="form-check-label" for="notifications">
                                    Notificações por Email
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estatísticas do Sistema</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-item text-center">
                                <h3 class="text-primary">150</h3>
                                <p class="text-muted">Usuários Cadastrados</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item text-center">
                                <h3 class="text-success">8</h3>
                                <p class="text-muted">Eventos Este Mês</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item text-center">
                                <h3 class="text-warning">R$ 12.500</h3>
                                <p class="text-muted">Dízimos Este Mês</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item text-center">
                                <h3 class="text-info">12</h3>
                                <p class="text-muted">Ministérios Ativos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

