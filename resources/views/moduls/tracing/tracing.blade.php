@extends('main')

@section('title')
    Seguimiento
@endsection

@section('stylesheets')
    @parent
    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('bodycontroller')
    id='tracingController' ng-controller='tracingController'
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Seguimiento</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Seguimiento</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" ng-show="estado_registro == 1">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Envios/Seguimiento</h4>
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
                                            <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" ng-model="registro.numero_documento" required>
                                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">Paciente</label>
                                        <input type="text" class="form-control" id="validationTooltip03" ng-model="registro.nombres_paciente" readonly>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Fecha de Cita:</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="City" ng-model="registro.fecha_cita" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Empresa</label>
                                        <select class="form-control" data-trigger name="choices-single-default"
                                                id="choices-single-default"
                                                placeholder="This is a search placeholder" ng-model="registro.idempresa">
                                            <option value="">---</option>
                                            <option value="Choice 1">Choice 1</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                        <button class="btn btn-warning" type="submit"><i class="fas fa-brain"></i> Limpiar</button>
                        <button class="btn btn-danger" type="submit"><i class="fas fa-recycle"></i> Salir</button>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="row" ng-show="estado_registro == 2">
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Motivo de Rechazar Envio</h4>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Descripcion del Motivo</label>
                                        <textarea class="form-control" ng-model="motivo.descripcion"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" type="submit"><i class="fas fa-recycle"></i> Salir</button>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="row" ng-show="estado_registro == 3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Confirmar la Fecha y Hora Programada</h4>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Fecha: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="" ng-model="confirmacion.fecha" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Hora: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="" ng-model="confirmacion.hora" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Costo: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="" ng-model="confirmacion.costo" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Nro. Boleto: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="" ng-model="confirmacion.nro_boleto" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" type="submit"><i class="fas fa-recycle"></i> Salir</button>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="row" ng-show="estado_registro == 4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lista de Seguimientos</h4>
                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
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
                                <th>Estado</th>
                                <th>Nro. Doc.</th>
                                <th>Nombre del Paciente</th>
                                <th>HC</th>
                                <th>Fecha de Cita</th>
                                <th>Empresa</th>
                                <th>Fecha y Hora Programada</th>
                                <th>Costo</th>
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
    <script src="js/angular/controller/tracing/tracingController.js"></script>
@endsection
