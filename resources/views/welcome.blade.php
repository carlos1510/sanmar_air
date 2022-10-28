@extends('main')

@section('title')
    Inicio
@endsection

@section('bodycontroller')
    id='homeController' ng-controller='homeController'
@endsection

@section('container-header')
    <strong>SISTEMA DE SEGUIMIENTO</strong>
@endsection

@section('content')
    <div class="row">
        @if(Session::get('idnivel') == 2 || Session::get('idnivel') == 1)
            <div class="col-lg-3">
                <a href="{{ url('vuelos') }}" style="text-decoration: none" >
                    <div class="card card-stats card-primary card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">VUELOS</p>
                                        <h4 class="card-title">Reserva de pasaje</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        @if(Session::get('idnivel') == 3 || Session::get('idnivel') == 1)
            <div class="col-lg-3">
                <a href="{{ url('reservados') }}" style="text-decoration: none" >
                    <div class="card card-stats card-success card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-plane-departure"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">VUELOS SOLICITADOS</p>
                                        <h4 class="card-title">Ver Pasajes Solicitados</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        @if(Session::get('idnivel') == 1)
            <div class="col-lg-3">
                <a href="{{ url('administrar_vuelo') }}" style="text-decoration: none" >
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-route"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">ADMINISTRAR VUELOS</p>
                                        <h4 class="card-title"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-3">
                <a href="{{ url('proforma') }}" style="text-decoration: none" >
                    <div class="card card-stats card-danger card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">PROFORMA</p>
                                        <h4 class="card-title">Generar Proforma</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endif
    </div>
    <div class="row">
        @if(Session::get('idnivel') == 1)
            <div class="col-lg-3">
                <a href="{{ url('empresa') }}" style="text-decoration: none" >
                    <div class="card card-stats card-warning card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Empresas</p>
                                        <h4 class="card-title">Gestionar Empresa</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-3">
                <a href="{{ url('usuario') }}" style="text-decoration: none" >
                    <div class="card card-stats card-secondary card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Usuarios</p>
                                        <h4 class="card-title">Gestión de Usuarios</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endif
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="js/angular/controller/homeController.js"></script>
@endsection
