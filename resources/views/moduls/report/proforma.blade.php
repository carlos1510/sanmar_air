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
                                    <button class="btn btn-primary btn-border dropdown-toggle" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" type="button">Generar PDF</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" ng-click="generarDeclaracionJurada()">D.J. Anexo 12</a>
                                        <a class="dropdown-item" href="javascript:void(0)" ng-click="generarDec_jurada_NEICE()">D.J. No estar Inhabilitado</a>
                                        <a class="dropdown-item" href="javascript:void(0)" ng-click="generarDec_jurada_pacto_integridad()">D.J. Pacto de Integridad</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Servicio: <span class="text-danger">(*)</span></label>
                                <select class="form-control" placeholder="Seleccione" id="tipoServiciocmb" ng-model="filtro.tipo_servicio" ng-change="limpiarLista()">
                                    <option value="">TODOS</option>
                                    <option value="PASAJE AEREO">PASAJE AEREO</option>
                                    <option value="VUELO CHARTER">VUELO CHARTER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ruta Origen - Destino: <span class="text-danger">(*)</span></label>
                                <select class="form-control" placeholder="Seleccione" id="rutaviajecmb" ng-model="filtro.idruta_viaje_precio" ng-change="limpiarLista()">
                                    <option value="">TODOS</option>
                                    <option ng-repeat="item in rutas" value="@{{ item.id }}">@{{ item.nom_ruta }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="validationTooltip04">Fecha Inicio: <span class="text-danger">(*)</span></label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control " type="text" id="fecha_iniciotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="filtro.fecha_inicio" ng-change="limpiarLista()" ng-blur="limpiarLista()">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="validationTooltip04">Fecha Final: <span class="text-danger">(*)</span></label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control " type="text" id="fecha_finaltxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="filtro.fecha_final" ng-change="limpiarLista()" ng-blur="limpiarLista()">
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
                                <button type="button" ng-show="lista.length > 0" class="btn btn-danger" ng-click="generarProforma()"><i class="fas fa-file-pdf"></i> Generar Proforma</button>
                                <button type="button" ng-show="lista.length > 0" class="btn btn-primary" ng-click="prepararOficio()"><i class="fas fa-file-pdf"></i> Generar Oficio</button>
                                <button type="button" ng-show="lista.length > 0" class="btn btn-warning" ng-click="prepararActaConformidad()"><i class="fas fa-file-pdf"></i> Generar Acta de Conformidad</button>
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
                            <th ng-show="filtro.tipo_servicio == 'VUELO CHARTER'">Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td class="text-center">@{{ ($index + 1) }}</td>
                                <td>@{{ item.descripcion }}</td>
                                <td class="text-center">@{{ item.cantidad }}</td>
                                <td class="text-center">@{{ item.unidad_medida }}</td>
                                <td class="text-right">S/. @{{ item.precio_unitario | number:2 }}</td>
                                <td class="text-right">S/. @{{ item.total | number:2 }}</td>
                                <td ng-show="filtro.tipo_servicio == 'VUELO CHARTER'">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#montoModal" ng-click="prepararAsignarMonto(item)"><i class="fas fa-money-bill-alt"></i></button>
                                </td>
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

    <div class="row" ng-show="estado_registro == 1">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Oficio a Generar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre del Año</label>
                                <input type="text" class="form-control" ng-model="oficio.nombre_anio" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>N° de Oficio: </label>
                                <input type="text" class="form-control" ng-model="oficio.nro_oficio" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Ruta:</label>
                                <input type="text" class="form-control" ng-model="oficio.nom_ruta" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Precio Total:</label>
                                <input type="text" class="form-control" ng-model="oficio.precio_total" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Fecha Desde:</label>
                                <input type="text" class="form-control" ng-model="oficio.fecha_inicio" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Fecha Hasta:</label>
                                <input type="text" class="form-control" ng-model="oficio.fecha_final" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Nro. Factura Electronica: <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" id="nro_facturatxt" ng-model="oficio.nro_factura" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary" ng-click="guardarOficio()"><i class="fas fa-file-pdf"></i> Guardar y Descargar</button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" ng-show="estado_registro == 2">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Acta de Conformidad a Generar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Ruta:</label>
                                <input type="text" class="form-control" ng-model="acta_conformidad.nom_ruta" readonly />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Precio Total:</label>
                                <input type="text" class="form-control" ng-model="acta_conformidad.precio_total" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Fecha Desde:</label>
                                <input type="text" class="form-control" ng-model="acta_conformidad.fecha_inicio" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Fecha Hasta:</label>
                                <input type="text" class="form-control" ng-model="acta_conformidad.fecha_final" readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary" ng-click="guardarActaConformidad()"><i class="fas fa-file-pdf"></i> Guardar y Descargar</button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="montoModal"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Asignar Precio del  </span>
                        <span class="fw-light"> Servicio CHARTER</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>RUTA</label>
                                <label class="form-control">@{{ asignar.nomb_origen_destino }}</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Monto: <span>(*)</span></label>
                                <input type="text" class="form-control numerico" id="precio_unitario_asignartxt" ng-model="asignar.precio_unitario" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" ng-click="guardarMontoCharter()" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Salir</button>
                </div>
            </div>
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
