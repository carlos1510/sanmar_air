@extends('main')

@section('title')
    Indicadores
@endsection

@section('bodycontroller')
    id='indicadoresController' ng-controller='indicadoresController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Indicadores</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Indicadores</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row" >
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Reporte Grafico de Ventas de Pasajes</div>
                        <div class="card-tools">
                            <ul id="pills-tab" class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" role="tablist">
                                <li class="nav-item submenu">
                                    <a id="pills-today" class="nav-link active show" aria-selected="true" role="tab" href="#pills-today" data-toggle="pill">Today</a>
                                </li>
                                <li class="nav-item submenu">
                                    <a id="pills-week" class="nav-link" aria-selected="false" role="tab" href="#pills-week" data-toggle="pill">Week</a>
                                </li>
                                <li class="nav-item submenu">
                                    <a id="pills-month" class="nav-link" aria-selected="false" role="tab" href="#pills-month" data-toggle="pill">Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <div id="myChartLegend">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="flaticon-graph"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sales</p>
                                <h4 class="card-title">$ 1,345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="flaticon-graph"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sales</p>
                                <h4 class="card-title">$ 1,345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent

@endsection
