@extends('main')

@section('title')
    Reservados
@endsection

@section('bodycontroller')
    id='reservedController' ng-controller='reservedController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Reservados</h4>
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
                <a href="#">Reservados</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row" ng-show="estado_registro == 1">
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
                                        <select id="estadocmb" class="form-control" ng-model="registro.estado">
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
                                        <label>Monto</label>
                                        <input class="form-control" type="text" id="montotxt" ng-model="registro.monto_empresa" placeholder="0.00" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
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
                                <button class="btn btn-primary btn-sm" ng-click="guardar()" title="Guardar"><i class="fas fa-save"></i> Confirmar</button>
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
                                <label>Estado:</label>
                                <select class="form-control" id="estado_busquedacmb" placeholder="Seleccione" ng-model="filtro.estado">
                                    <option value="">TODOS</option>
                                    <option value="1">PENDIENTE</option>
                                    <option value="2">ACEPTADO</option>
                                    <option value="3">OBSERVADO</option>
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
                                <input type="text" class="form-control numero" ng-model="filtro.numero_documento" maxlength="8">
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
                        <table class="table table-bordered table-hover" datatable="ng" dt-options="elementos.dtOptions" dt-instance="dtInstance">
                            <thead>
                            <th>#</th>
                            <th></th>
                            <th>DNI.</th>
                            <th>PASAJERO.</th>
                            <th>TELEFONO</th>
                            <th>EDAD</th>
                            <th>TIPO DE PASAJERO</th>
                            <th>PAC/ACOMP.</th>
                            <th>TIPO DE SERVICIO</th>
                            <th>ORIGEN - DESTINO</th>
                            <th>FECHA DE CITA</th>
                            <th>FECHA DE VIAJE</th>
                            <th>Monto</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td>@{{ ($index + 1) }}</td>
                                <td class="text-center"><i ng-class="{'flaticon-success text-success text-xl-center': item.estado==2, 'flaticon-exclamation text-warning': item.estado==3, 'flaticon-round text-primary': item.estado==1}"></td>
                                <td>@{{ item.numero_documento }}</td>
                                <td>@{{ item.apellido_paterno }} @{{ item.apellido_materno }} @{{ item.nombres }}</td>
                                <td>@{{ item.telefono }}</td>
                                <td>@{{ item.edad }}</td>
                                <td>@{{ item.tipo_pasajero }}</td>
                                <td>@{{ item.tipo_paciente }}</td>
                                <td>@{{ item.tipo_servicio }}</td>
                                <td>@{{ item.nomb_origen_destino }}</td>
                                <td>@{{ item.fecha_cita }}</td>
                                <td>@{{ item.fecha_viaje }}</td>
                                <td>@{{ item.monto_empresa }}</td>
                                <td>
                                    <div class="text-center align-items-center justify-content-center" ng-show="item.estado == 1">
                                        <button ng-show="item.tipo_paciente=='PACIENTE'" class="btn btn-success btn-sm"  ng-click="prepararEditar(item)"  title="Reservar"><i class="fas fa-check"></i></button>
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
@endsection

@section('javascripts')
    @parent
    <script src="js/angular/controller/fligth/reservedController.js"></script>
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
        })
    </script>
@endsection
