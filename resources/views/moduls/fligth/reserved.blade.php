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
                    <h4 class="card-title">Registrar Empresa</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip01">RUC.:</label>
                                    <input type="text" class="form-control numero" id="ructxt" placeholder="" maxlength="11" ng-model="registro.ruc" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip02">RAZON SOCIAL:</label>
                                    <input type="text" class="form-control" id="razonsocialtxt" ng-model="registro.razon_social" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltipUsername">TELEFONO:</label>
                                    <input type="text" class="form-control numero" maxlength="9" ng-model="registro.telefono" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip03">DIRECCION</label>
                                    <input type="text" class="form-control" ng-model="registro.direccion" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip04">CORREO ELECTRONICO</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span id="basic-addon1" class="input-group-text">@</span>
                                        </div>
                                        <input class="form-control" type="text" ng-model="registro.correo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="button" ng-click="guardar()"><i class="fas fa-save"></i> GUARDAR</button>
                        <button class="btn btn-danger" type="button" ng-click="salir()"><i class="fas fa-times"></i> SALIR</button>
                    </form>
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
    <script src="js/angular/controller/fligth/reservedController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});
        })
    </script>
@endsection
