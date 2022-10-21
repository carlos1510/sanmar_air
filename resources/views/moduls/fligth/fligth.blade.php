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
    <div class="row" ng-show="estado_registro == 1">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registrar Reserva de Pasajes</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                            <h4>Datos del Paciente
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
                                        <select class="form-control" data-trigger id="idtipodocumentocmb" placeholder="Seleccione" ng-change="tipo_busqueda_persona()" ng-model="registro.idtipo_documento">
                                            <option value="">---</option>
                                            <option value="1">DNI</option>
                                            <option value="2">CARNET DE EXTRANJERIA</option>
                                            <option value="3">PASAPORTE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Numero Documento <span class="text-danger">(*)</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="numerodocumentotxt" placeholder="" ng-model="registro.numero_documento" required>
                                            <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumento()"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">Apellido Paterno <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="apellido_paternotxt" ng-model="registro.apellido_paterno" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">Apellido Materno <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="apellido_maternotxt"  ng-model="registro.apellido_materno" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">Nombres <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="nombrestxt" ng-model="registro.nombres" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">Fecha Nacimiento</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input class="form-control " type="text" id="fecha_nacimientotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label>Edad <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control numero" id="edadtxt" ng-model="registro.edad" maxlength="2" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Telefono <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control numero" id="telefonotxt" maxlength="9" ng-model="registro.telefono" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Sexo</label>
                                        <select class="form-control" data-trigger id="sexocmb" placeholder="Seleccione" ng-model="registro.sexo">
                                            <option value="">---</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                            <h4>Datos del Pasaje
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <label>Servicios</label>
                                        <br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" value="VUELOS" name="servicioRadios" ng-model="registro.tipo_servicio">
                                            <span class="form-radio-sign">Vuelos</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" value="VUELOS CHARTER" name="servicioRadios" ng-model="registro.tipo_servicio">
                                            <span class="form-radio-sign">Vuelos Charter</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <label>Vuelos</label>
                                        <br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" value="IDA Y VUELTA" name="vuelosRadios" ng-model="registro.vuelos">
                                            <span class="form-radio-sign">Ida y Vuelta</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" value="SOLO IDA" name="vuelosRadios" ng-model="registro.vuelos">
                                            <span class="form-radio-sign">Sólo Ida</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Origen - Destino <span class="text-danger">(*)</span></label>
                                        <select class="form-control" data-trigger id="origen_destinocmb" placeholder="Seleccione" ng-model="registro.idruta_viaje_precio">
                                            <option value="">---</option>
                                            <option ng-repeat="item in rutas" value="@{{ item.id }}">@{{ item.nom_ruta }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">Fecha Cita <span class="text-danger">(*)</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input class="form-control " type="text" id="fecha_citatxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_cita">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">Fecha Salida</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input class="form-control " type="text" id="fecha_salidatxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_salida">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Tipo de Pasajero <span class="text-danger">(*)</span></label>
                                        <select class="form-control" data-trigger id="tipopasajerocmb" placeholder="Seleccione" ng-model="registro.tipo_pasajero">
                                            <option value="">---</option>
                                            <option value="ADULTO">ADULTO</option>
                                            <option value="INFANTE">INFANTE</option>
                                            <option value="NIÑO">NIÑO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                            <h4>Datos Acompañante(s)
                                <button type="button" class="btn btn-icon btn-primary btn-round btn-sm" title="Agregar Acompañante" ng-click="addAcompanante()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </h4>
                            <div class="row" ng-repeat="item in registro.detalle_acompanante">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>DNI:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="" id="numero_documentotxt_@{{ $index }}" ng-model="item.numero_documento" required>
                                            <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumentoAcomp($index, item)"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="validationTooltip01">Apellido Paterno</label>
                                        <input type="text" class="form-control" ng-model="item.apellido_paterno" >
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="validationTooltip01">Apellido Materno</label>
                                        <input type="text" class="form-control" ng-model="item.apellido_materno" >
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="validationTooltip01">Nombres</label>
                                        <input type="text" class="form-control" ng-model="item.nombres" >
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="form-label" for="validationTooltip01">Edad</label>
                                        <input type="text" class="form-control" ng-model="item.edad" >
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="choices-single-default" class="form-label ">Tipo de Pasajero</label>
                                        <select class="form-control" data-trigger placeholder="Seleccione" ng-model="item.tipo_pasajero">
                                            <option value="">---</option>
                                            <option value="ADULTO">ADULTO</option>
                                            <option value="INFANTE">INFANTE</option>
                                            <option value="NIÑO">NIÑO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="text-center align-items-center justify-content-center" style="padding-top: 35px !important;">
                                        <button class="btn btn-icon btn-danger btn-round btn-sm" title="Quitar Acompañante" ng-click="removeAcompanante($index)">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row">
                            <label>Adjuntar Documentos</label> <button type="button" class="ml-2 btn btn-default btn-sm"><i class="flaticon-tool"></i> Agregar</button>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Documento</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="file" class="file" />
                                                </td>
                                                <td>
                                                    <div class="text-center align-items-center justify-content-center">
                                                        <button class="btn btn-danger btn-sm" title="Eliminar" ><i class="fas fa-times"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>--}}
                    </form>
                </div>
                <div class="card-footer">
                    <div class="text-center align-items-center justify-content-center">
                        <button class="btn btn-primary" type="button" ng-click="guardar()"><i class="fas fa-save"></i> GUARDAR</button>
                        <button class="btn btn-danger" type="button" ng-click="salir()"><i class="fas fa-times"></i> SALIR</button>
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
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select class="form-control" placeholder="Seleccione">
                                    <option value="">TODOS</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="ACEPTADO">ACEPTADO</option>
                                    <option value="NO ACEPTADO">NO ACEPTADO</option>
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
                                    <input class="form-control " type="text" id="fecha_iniciotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="buscar.fecha_inicio">
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
                                    <input class="form-control " type="text" id="fecha_finaltxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="buscar.fecha_final">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding-top: 35px !important;">
                                <button type="button" class="btn btn-block btn-default"><i class="fas fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <th></th>
                            <th>#</th>
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
                                <td></td>
                                <td>@{{ ($index + 1) }}</td>
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
                                    {{--<div class="text-center align-items-center justify-content-center">
                                        <button class="btn btn-success btn-sm"  ng-click="prepararEditar(item)"  title="Editar"><i class="fas fa-edit"></i></button>
                                    </div>--}}
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
                format: 'dd/mm/yyyy'
            });

            $('#fecha_salidatxt').datepicker({
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
                format: 'dd/mm/yyyy',
                endDate: new Date()
            });

            $('#fecha_finaltxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                endDate: new Date()
            });
        })
    </script>
@endsection
