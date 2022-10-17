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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Tipo Documento</label>
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
                                    <label class="form-label" for="validationTooltipUsername">Numero Documento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="numerodocumentotxt" placeholder="" ng-model="registro.numero_documento" required>
                                        <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumento()"><i class="fas fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip01">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="validationTooltip01" ng-model="registro.apellido_paterno" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip02">Apellido Materno</label>
                                    <input type="text" class="form-control" id="validationTooltip02"  ng-model="registro.apellido_materno" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip03">Nombres</label>
                                    <input type="text" class="form-control" id="validationTooltip03" ng-model="registro.nombres" required>
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
                                    <label>Edad</label>
                                    <input type="text" class="form-control numero" ng-click="registro.edad" maxlength="2" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Telefono</label>
                                    <input type="text" class="form-control" id="validationTooltip04" maxlength="9" ng-model="registro.telefono" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Sexo</label>
                                    <select class="form-control" data-trigger id="sexocmb" placeholder="Seleccione" ng-model="registro.sexo">
                                        <option value="">---</option>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMENINO">Femenino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <label>Vuelos</label>
                                    <br>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" checked="" value="" name="optionsRadios">
                                        <span class="form-radio-sign">Ida y Vuelta</span>
                                    </label>
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" value="" name="optionsRadios">
                                        <span class="form-radio-sign">Sólo Ida</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Origen - Destino</label>
                                    <select class="form-control" data-trigger id="sexocmb" placeholder="Seleccione" ng-model="registro.sexo">
                                        <option value="">---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip04">Fecha Cita</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input class="form-control " type="text" id="fecha_citatxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_nacimiento">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Tipo de Pasajero</label>
                                    <select class="form-control" data-trigger id="sexocmb" placeholder="Seleccione" ng-model="registro.sexo">
                                        <option value="">---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Pasajeros</label>
                                    <input type="text" class="form-control numero" id="validationTooltip04" maxlength="1" ng-model="registro.telefono" >
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
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
                        </div>
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
                                    <input class="form-control " type="text" id="fecha_nacimientotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_nacimiento">
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
                                    <input class="form-control " type="text" id="fecha_nacimientotxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_nacimiento">
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
                            <th>DNI.</th>
                            <th>PASAJERO.</th>
                            <th>TELEFONO</th>
                            <th>EDAD</th>
                            <th>TIPO DE PASAJERO</th>
                            <th>ORIGEN - DESTINO</th>
                            <th>FECHA DE CITA</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td></td>
                                <td>@{{ ($index + 1) }}</td>
                                <td>@{{ item.ruc }}</td>
                                <td>@{{ item.razon_social }}</td>
                                <td>@{{ item.telefono }}</td>
                                <td>@{{ item.direccion }}</td>
                                <td>@{{ item.correo }}</td>
                                <td>@{{ item.correo }}</td>
                                <td>@{{ item.correo }}</td>
                                <td>
                                    <div class="text-center align-items-center justify-content-center">
                                        <button class="btn btn-success btn-sm"  ng-click="prepararEditar(item)"  title="Editar"><i class="fas fa-edit"></i></button>
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
    <script src="js/angular/controller/fligth/fligthController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});
        })
    </script>
@endsection
