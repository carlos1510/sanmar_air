@extends('main')

@section('title')
    Paciente
@endsection

@section('bodycontroller')
    id='patientController' ng-controller='patientController'
@endsection

@section('stylesheets')
    @parent
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Paciente</h4>
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
                <a href="#">Paciente</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <div ng-show="estado_registro == 1" class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registro de Pacientes</h4>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Tipo Documento</label>
                                        <select class="form-control" data-trigger name="choices-single-default"
                                                id="idtipodocumentocmb"
                                                placeholder="Seleccione" ng-model="registro.idtipo_documento">
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
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Sexo</label>
                                        <select class="form-control" data-trigger name="choices-single-default"
                                                id="sexocmb"
                                                placeholder="Seleccione" ng-model="registro.sexo">
                                            <option value="">---</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Telefono</label>
                                        <input type="text" class="form-control" id="validationTooltip04" maxlength="9" ng-model="registro.telefono" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Historia Clinica</label>
                                        <input type="text" class="form-control" id="validationTooltip04" ng-model="registro.hc" >
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

        <div ng-show="estado_registro == 0" class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <h4 class="card-title">Lista de Pacientes</h4>
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

                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Tipo Doc.</th>
                                    <th>Nro. Doc.</th>
                                    <th>Nombre del Paciente</th>
                                    <th>HC</th>
                                    <th>Sexo</th>
                                    <th>Telefono</th>
                                    <th>Fecha Nac.</th>
                                    <th>Acción</th>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in lista">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-success btn-sm" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-times"></i></button>
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

    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('js/angular/controller/register/patientController.js') }}"></script>

    <script>
        $(function (){
            $('#fecha_nacimientotxt').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                endDate: new Date()
            });
        });
    </script>
@endsection
