@extends('main')

@section('title')
    Empresa
@endsection

@section('bodycontroller')
    id='companyController' ng-controller='companyController'
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Empresa</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Empresa</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

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
                                        <input type="text" class="form-control" id="validationTooltip01" placeholder="" ng-model="registro.ruc" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">RAZON SOCIAL:</label>
                                        <input type="text" class="form-control" id="validationTooltip02" ng-model="registro.razon_social" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">TELEFONO:</label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.telefono" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">DIRECCION</label>
                                        <input type="text" class="form-control" id="validationTooltip03" ng-model="registro.direccion" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">CORREO ELECTRONICO</label>
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                        <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.correo" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">GUARDAR</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="row" ng-show="estado_registro == 0">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lista de Empresas</h4>
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
                                <th>RUC.</th>
                                <th>RAZON SOCIAL.</th>
                                <th>TELEFONO</th>
                                <th>DIRECCION</th>
                                <th>CORREO</th>
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
    <script src="js/angular/controller/register/companyController.js"></script>
@endsection
