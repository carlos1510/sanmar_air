@extends('main')

@section('title')
    Vuelos
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
                                <button type="button" class="btn btn-warning" ng-click="imprimirTickets()"><i class="fas fa-print"></i> Imprimir</button>
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
                                <input type="checkbox" ng-model="filtro.check_total" />
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
                                    <input type="checkbox" ng-model="item.check" />
                                </th>
                                <td><span class="pl-3 " ng-class="{'text-primary': item.estado==1, 'text-success': item.estado==2, 'text-warning': item.estado==3}">@{{ item.nom_estado }}</span></td>
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

@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('js/jspdf.min.js') }}"></script>
    <script src="js/angular/controller/fligth/fligthController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});
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
