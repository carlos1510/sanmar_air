@extends('main')

@section('title')
    Vuelos
@endsection

@section('stylesheets')
    @parent
@endsection

@section('bodycontroller')
    id='fligthController' ng-controller='fligthController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Vuelos</h4>
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
                <a href="#">Vuelos</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    @include('moduls.fligth.formRegisterFligth')

    <div class="row" ng-show="estado_registro == 0">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Lista de Pasajes</h4>
                        <div class="card-tools">
                            <ul id="pills-tab" class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" role="tablist">
                                <li class="nav-item submenu">
                                    <a class="btn btn-primary btn-round text-white" ng-click="nuevoRegistro()" ><i class="fas fa-plus"></i> Nuevo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select class="form-control" id="estadobuscarcmb" placeholder="Seleccione" ng-model="filtro.estado">
                                    <option value="">TODOS</option>
                                    <option value="1">PENDIENTE</option>
                                    <option value="2">RECIBIDO</option>
                                    <option value="3">ACEPTADO</option>
                                    <option value="4">OBSERVADOS</option>
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control" ng-model="filtro.numero_documento">
                            </div>
                        </div>

                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center align-items-center justify-content-center">
                                <button type="button" class="btn btn-default" ng-click="listar()"><i class="fas fa-search"></i> Buscar</button>
                                <button type="button" class="btn btn-warning" ng-disabled="contarMarcados() == 0" ng-click="imprimirTickets()"><i class="fas fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" datatable="ng" dt-options="elementos.dtOptions" dt-instance="dtInstance" >
                            <thead>
                            <th>#</th>
                            <th>
                                <input type="checkbox" ng-model="filtro.check_total" ng-change="marcarCheckBox()" />
                            </th>
                            <th>ESTADO</th>
                            <th>DNI.</th>
                            <th>PASAJERO.</th>
                            <th>TELEFONO</th>
                            <th>EDAD</th>
                            <th>TIPO SERVICIO</th>
                            <th>VUELOS</th>
                            <th>TIPO DE PASAJERO</th>
                            <th>ORIGEN - DESTINO</th>
                            <th>FECHA DE CITA</th>
                            <th>FECHA VIAJE/SALIDA</th>
                            <th>PAC/ACOM</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td>@{{ ($index + 1) }}</td>
                                <th>
                                    <input type="checkbox" ng-model="item.check_imprimir" ng-change="desmarcarTotalCheck(item)" />
                                </th>
                                <td><span class="pl-3 " ng-class="{'text-primary': item.estado==1, 'text-success': item.estado==2, 'text-success': item.estado==3,'text-warning': item.estado==4}">@{{ item.nom_estado }}</span></td>
                                <td>@{{ item.numero_documento }}</td>
                                <td>@{{ item.apellido_paterno }} @{{ item.apellido_materno }} @{{ item.nombres }}</td>
                                <td>@{{ item.telefono }}</td>
                                <td>@{{ item.edad }}</td>
                                <td>@{{ item.tipo_servicio }}</td>
                                <td>@{{ item.vuelos }}</td>
                                <td>@{{ item.tipo_pasajero }}</td>
                                <td>@{{ item.nomb_origen_destino }}</td>
                                <td>@{{ item.fecha_cita }}</td>
                                <td>@{{ item.fecha_salida }}</td>
                                <td>@{{ item.tipo_paciente }}</td>
                                <td>
                                    <center>
                                        @if(Session::get('idnivel') == 1 || Session::get('idnivel') == 2)
                                            <button class="btn btn-primary btn-xs" ng-show="item.tipo_paciente=='PACIENTE' && item.estado!=2" ng-click="prepararRecibirPasaje(item)" title="Recibir Orden de Pasaje"><i class="fas fa-check"></i></button>
                                        @endif
                                        <button class="btn btn-success btn-xs" ng-show="item.tipo_paciente=='PACIENTE'" ng-click="prepararEditar(item)"  title="Editar"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-xs" ng-show="item.tipo_paciente=='PACIENTE'" ng-click="eliminarViaje(item)" title="Eliminar"><i class="fas fa-times"></i></button>
                                    </center>
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
                                        <label class="form-label" ng-show="registro.tipo_servicio == 'PASAJE AEREO'" >Fecha Cita <span class="text-danger">(*)</span></label>
                                        <label class="form-label" ng-show="registro.tipo_servicio == 'VUELO CHARTER'">Fecha de Charter <span class="text-danger">(*)</span></label>
                                        <input class="form-control" type="text" ng-model="registro.fecha_cita" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Estado</label>
                                        <select id="estadoRecibidocmb" class="form-control" ng-model="registro.estado">
                                            <option value="1">Pendiente</option>
                                            <option value="2">Recibido</option>
                                            <option value="4">Observado</option>
                                        </select>
                                    </div>
                                </div>
                                @if(Session::get('idnivel') == 1)
                                    <div class="col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Empresa: </label>
                                            <select id="empresaRecibidocmb" class="form-control" ng-model="registro.idempresa">
                                                <option value="">----</option>
                                                <option ng-repeat="item in empresas" value="@{{ item.idempresa }}">@{{ item.razon_social }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-4">
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

                            <div class="row" ng-show="registro.detalle_personal.length == 0">
                                <div class="col-lg-12" >
                                    <div class="view-profile">
                                        <span class="btn btn-secondary btn-block" >No Cuenta con Personal de Salud</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" ng-show="registro.detalle_personal.length > 0">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th colspan="5" class="text-center">DATOS DEL PERSONAL DE SALUD</th>
                                            </tr>
                                            <tr>
                                                <th>DNI</th>
                                                <th>NOMBRES</th>
                                                <th>EDAD</th>
                                                <th>TIPO PASAJERO</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in registro.detalle_personal">
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
                                <button class="btn btn-primary btn-sm" ng-click="guardarRecibirPasaje()" title="Recibir Pasaje"><i class="fas fa-check"></i> Recibir</button>
                                <button class="btn btn-danger btn-sm" ng-click="salir()" title="Salir"><i class="fas fa-times"></i> Salir</button>
                            </div>
                        </div>
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
    <script src="js/angular/controller/fligth/fligthController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});
            var archivo = document.getElementById('archivos');
            archivo.value = '';
            $('#fecha_nacimientotxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                endDate: new Date()
            });
            $('#fecha_citatxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
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
