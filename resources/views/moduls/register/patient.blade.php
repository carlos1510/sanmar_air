@extends('main')

@section('title')
    Paciente
@endsection

@section('bodycontroller')
    id='patientController' ng-controller='patientController'
@endsection

@section('stylesheets')
    @parent
    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Paciente</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Paciente</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

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
                                                id="choices-single-default"
                                                placeholder="This is a search placeholder" ng-model="registro.idtipo_documento">
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
                                            <input type="text" class="form-control" id="validationTooltipUsername" placeholder="" ng-model="registro.numero_documento" required>
                                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="validationTooltip01" ng-model="registro.apellido_paterno" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">Apellido Materno</label>
                                        <input type="text" class="form-control" id="validationTooltip02"  ng-model="registro.apellido_materno" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">Nombres</label>
                                        <input type="text" class="form-control" id="validationTooltip03" ng-model="registro.nombres" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">Fecha Nacimiento</label>
                                        <input type="text" class="form-control" id="validationTooltip04" ng-model="registro.fecha_nacimiento" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Sexo</label>
                                        <select class="form-control" data-trigger name="choices-single-default"
                                                id="choices-single-default"
                                                placeholder="This is a search placeholder" ng-model="registro.sexo">
                                            <option value="">---</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Telefono</label>
                                        <input type="text" class="form-control" id="validationTooltip04" maxlength="9" ng-model="registro.telefono" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Historia Clinica</label>
                                        <input type="text" class="form-control" id="validationTooltip04" ng-model="registro.hc" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div ng-show="estado_registro == 0" class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lista de Pacientes</h4>
                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-primary" ng-click="nuevo()"><i class="fas fa-plus"></i> Nuevo</button>
                                </li>
                            </ul>
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
    <!-- choices js -->
    <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="{{ asset('js/angular/controller/register/patientController.js') }}"></script>
@endsection
