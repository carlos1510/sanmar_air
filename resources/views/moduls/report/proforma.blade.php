@extends('main')

@section('title')
    Proforma
@endsection

@section('bodycontroller')
    id='proformaController' ng-controller='proformaController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Proforma</h4>
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
                <a href="#">Proforma</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="row" ng-show="estado_registro == 0">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Reporte de Proformas - Pasajes</h4>
                        <div class="card-tools">
                            <ul id="pills-tab" class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" role="tablist">
                                <li class="nav-item submenu">
                                    <button type="submit" class="btn btn-primary btn-round text-white" ng-click="generarDeclaracionJurada()" ><i class="fas fa-file-pdf"></i> Declaración Jurada</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Servicio</label>
                                <select class="form-control" placeholder="Seleccione" id="tipoServiciocmb" ng-model="filtro.tipo_servicio">
                                    <option value="">TODOS</option>
                                    <option value="PASAJE AEREO">PASAJE AEREO</option>
                                    <option value="VUELO CHARTER">VUELO CHARTER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ruta Origen - Destino</label>
                                <select class="form-control" placeholder="Seleccione" id="rutaviajecmb" ng-model="filtro.idruta_viaje_precio">
                                    <option value="">TODOS</option>
                                    <option ng-repeat="item in rutas" value="@{{ item.id }}">@{{ item.nom_ruta }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="validationTooltip04">Fecha Inicio</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control " type="text" id="fecha_iniciotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="filtro.fecha_inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="validationTooltip04">Fecha Final</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control " type="text" id="fecha_finaltxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="filtro.fecha_final">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center align-items-center justify-content-center">
                                <button type="button" class="btn btn-default" ng-click="listar()"><i class="fas fa-search"></i> Buscar</button>
                                {{--<button type="button" class="btn btn-danger" ng-show="lista.length > 0 && filtro.tipo_servicio!='' && filtro.idruta_viaje_precio!=''" ng-click="generarProforma()"><i class="fas fa-file-pdf"></i> Descargar</button>--}}
                                <button type="button" class="btn btn-danger" ng-click="generarProforma()"><i class="fas fa-file-pdf"></i> Descargar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <th>ITEM</th>
                            <th>DESCRIPCION</th>
                            <th>CANTIDAD</th>
                            <th>UNIDAD DE MEDIDA</th>
                            <th>P.U.</th>
                            <th>PRECIO TOTAL (Soles)</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td class="text-center">@{{ ($index + 1) }}</td>
                                <td>@{{ item.descripcion }}</td>
                                <td class="text-center">@{{ item.cantidad }}</td>
                                <td class="text-center">@{{ item.unidad_medida }}</td>
                                <td class="text-right">S/. @{{ item.precio_unitario | number:2 }}</td>
                                <td class="text-right">S/. @{{ item.total | number:2 }}</td>
                            </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-center">VALOR TOTAL DE LA COTIZACION</th>
                                    <th class="text-right text-black">S/. @{{ total | number:2 }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('js/jspdf.min.js') }}"></script>
    <script src="{{ asset('js/angular/controller/report/proformaController.js') }}"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});

            $('#fecha_iniciotxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });

            $('#fecha_finaltxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });
        })
    </script>
@endsection
