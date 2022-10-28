@extends('main')

@section('title')
    Administrar Vuelos
@endsection

@section('bodycontroller')
    id='manageFligthController' ng-controller='manageFligthController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Administrar Vuelos</h4>
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
                <a href="#">Administrar Vuelos</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    @include('moduls.fligth.formRegisterFligth')

    <div class="row" ng-show="estado_registro == 2">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Confirmar Reserva de Pasaje</h4>
                </div>
                <div class="card-body">
                    <div class="card card-profile card-secondary">
                        <div class="card-header" >
                            <h1 class="text-white text-center">DATOS DEL PASAJERO</h1>
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img class="avatar-img rounded-circle" alt="..." src="img/@{{ registro.sexo }}.jpg">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">Nro. Documento: @{{ registro.numero_documento }}</div>
                                <div class="name">Nombres: @{{ registro.nombres }} @{{ registro.apellido_parterno }} @{{ registro.apellido_materno }}</div>
                                <div class="job">Género: @{{ registro.sexo }}</div>
                                <div class="job">Telefono: @{{ registro.telefono }} | Edad: @{{ registro.edad }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="view-profile">
                                        <span class="btn btn-secondary btn-block" >DATOS DEL PASAJE</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group form-group-default">
                                        <label>Tipo de Servicio</label>
                                        <input class="form-control" type="text" ng-model="registro.tipo_servicio" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-group-default">
                                        <label>Origen - Destino</label>
                                        <input class="form-control" type="text" ng-model="registro.nomb_origen_destino" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-group-default">
                                        <label>Tipo de Pasajero</label>
                                        <input class="form-control" type="text" ng-model="registro.tipo_pasajero" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-group-default">
                                        <label>Fecha de Cita</label>
                                        <input class="form-control" type="text" ng-model="registro.fecha_cita" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Estado</label>
                                        <select id="estadoAsignadocmb" class="form-control" ng-model="registro.estado">
                                            <option value="1">Pendiente</option>
                                            <option value="2">Aceptado</option>
                                            <option value="3">Observado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Fecha de Viaje</label>
                                        <input id="fecha_viajetxt" class="form-control" autocomplete="off" type="text" placeholder="Fecha de Viaje" ng-model="registro.fecha_viaje" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Precio Unitario</label>
                                        <input class="form-control" type="text" id="precio_unitariotxt" ng-model="registro.precio_unitario" placeholder="0.00" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Empresa: <span class="text-danger">(*)</span></label>
                                        <select id="empresaAsignarcmb" class="form-control" ng-model="registro.idempresa">
                                            <option value="">----</option>
                                            <option ng-repeat="item in empresas" value="@{{ item.idempresa }}">@{{ item.razon_social }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group form-group-default">
                                        <label>Observación</label>
                                        <textarea class="form-control" rows="3" placeholder="Observacion" ng-model="registro.observacion"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" ng-show="registro.detalle_acompanante.length == 0">
                                <div class="col-lg-12" >
                                    <div class="view-profile">
                                        <span class="btn btn-secondary btn-block" >No Cuenta con Acompañante(s)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" ng-show="registro.detalle_acompanante.length > 0">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th colspan="5" class="text-center">DATOS DEL ACOMPAÑANTE</th>
                                            </tr>
                                            <tr>
                                                <th>DNI</th>
                                                <th>NOMBRES</th>
                                                <th>EDAD</th>
                                                <th>TIPO PASAJERO</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in registro.detalle_acompanante">
                                                <td>@{{ item.numero_documento }}</td>
                                                <td>@{{ item.nombres_persona }}</td>
                                                <td>@{{ item.edad }}</td>
                                                <td>@{{ item.tipo_pasajero }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center align-items-center justify-content-center">
                                <button class="btn btn-primary btn-sm" ng-click="guardarAsignacion()" title="Guardar"><i class="fas fa-save"></i> Confirmar</button>
                                <button class="btn btn-danger btn-sm" ng-click="salir()" title="Salir"><i class="fas fa-times"></i> Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

    <div class="row" ng-show="estado_registro == 0">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Lista de Pasajes Reservados</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Tipo de Servicio:</label>
                                <select class="form-control" placeholder="Seleccione" ng-model="filtro.tipo_servicio">
                                    <option value="">TODOS</option>
                                    <option value="PASAJE AEREO">PASAJE AEREO</option>
                                    <option value="VUELO CHARTER">VUELO CHARTER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select class="form-control" id="estadobuscarcmb" placeholder="Seleccione" ng-model="filtro.estado">
                                    <option value="">TODOS</option>
                                    <option value="1">PENDIENTE</option>
                                    <option value="2">ACEPTADO</option>
                                    <option value="3">OBSERVADOS</option>
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
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control" ng-model="filtro.numero_documento">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ruta Origen - Destino</label>
                                <select class="form-control" placeholder="Seleccione" id="rutaviajecmb" ng-model="filtro.idruta_viaje_precio">
                                    <option value="">TODOS</option>
                                    <option ng-repeat="item in rutas" value="@{{ item.id }}">@{{ item.nom_ruta }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding-top: 35px !important;">
                                <button type="button" class="btn btn-block btn-default" ng-click="listar()"><i class="fas fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <th>#</th>
                            <th></th>
                            <th>TIPO DE RESERVA</th>
                            <th>DNI.</th>
                            <th>PASAJERO.</th>
                            <th>TELEFONO</th>
                            <th>EDAD</th>
                            <th>TIPO DE PASAJERO</th>
                            <th>PAC/ACOMP.</th>
                            <th>ORIGEN - DESTINO</th>
                            <th>FECHA DE CITA</th>
                            <th>FECHA DE VIAJE</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td>@{{ ($index + 1) }}</td>
                                <td class="text-center"><i ng-class="{'flaticon-success text-success text-xl-center': item.estado==2, 'flaticon-exclamation text-warning': item.estado==3, 'flaticon-round text-primary': item.estado==1}"></i></td>
                                <td>@{{ item.tipo_servicio }}</td>
                                <td>@{{ item.numero_documento }}</td>
                                <td>@{{ item.apellido_paterno }} @{{ item.apellido_materno }} @{{ item.nombres }}</td>
                                <td>@{{ item.telefono }}</td>
                                <td>@{{ item.edad }}</td>
                                <td>@{{ item.tipo_pasajero }}</td>
                                <td>@{{ item.tipo_paciente }}</td>
                                <td>@{{ item.nomb_origen_destino }}</td>
                                <td>@{{ item.fecha_cita }}</td>
                                <td>@{{ item.fecha_viaje }}</td>
                                <td>
                                    <div class="text-center align-items-center justify-content-center">
                                        <button type="button" ng-show="item.estado==3 && item.tipo_paciente=='PACIENTE'" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#verObservacionModal" ng-click="prepararVerObservacion(item)" title="Ver Observacion"><i class="fas fa-eye"></i></button>
                                        <button type="button" ng-show="item.estado==3 && item.tipo_paciente=='PACIENTE'" class="btn btn-success btn-sm"  ng-click="prepararEditar(item)"  title="Editar"><i class="fas fa-edit"></i></button>
                                        <button type="button" ng-show="item.estado==1 && item.tipo_paciente=='PACIENTE'" class="btn btn-primary btn-sm" ng-click="prepararAsignar(item)" title="Asignar Empresa"><i class="fas fa-check"></i></button>
                                        <button type="button" ng-show="(item.estado==1 || item.estado==3) && item.tipo_paciente=='PACIENTE'" class="btn btn-danger btn-sm" ng-click="eliminarPasaje(item)" title="Anular o Eliminar"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

    <div class="modal fade" id="verObservacionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Observaciones en el Paciente: </span>
                        <span class="fw-light"> @{{ registro.nombres }} / @{{ registro.numero_documento }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group form-group-default">
                                <label>Observacion: </label>
                                <textarea class="form-control" rows="3" placeholder="Observacion" ng-model="registro.observacion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Salir</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="js/angular/controller/fligth/manageFligthController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});

            $('#fecha_viajetxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });

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

            $('#fecha_citatxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: new Date()
            });

            $('#fecha_salidatxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: new Date()
            });
        })
    </script>
@endsection
