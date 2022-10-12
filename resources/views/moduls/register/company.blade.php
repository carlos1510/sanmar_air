@extends('main')

@section('title')
    Empresa
@endsection

@section('bodycontroller')
    id='companyController' ng-controller='companyController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Empresa</h4>
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
                <a href="#">Empresa</a>
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
                                    <input type="text" class="form-control" id="ructxt" placeholder="" ng-model="registro.ruc" required>
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
                                    <input type="text" class="form-control" ng-model="registro.telefono" >
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
                        <h4 class="card-title">Lista de Empresas</h4>
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
                            <th>RUC.</th>
                            <th>RAZON SOCIAL.</th>
                            <th>TELEFONO</th>
                            <th>DIRECCION</th>
                            <th>CORREO</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in lista">
                                <td>@{{ ($index + 1) }}</td>
                                <td>@{{ item.ruc }}</td>
                                <td>@{{ item.razon_social }}</td>
                                <td>@{{ item.telefono }}</td>
                                <td>@{{ item.direccion }}</td>
                                <td>@{{ item.correo }}</td>
                                <td>
                                    <div class="text-center align-items-center justify-content-center">
                                        <button class="btn btn-success btn-sm"  ng-click="prepararEditar(item)"  title="Editar"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar" ng-click="eliminarEmpresa(item)"><i class="fas fa-times"></i></button>
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
    <script src="js/angular/controller/register/companyController.js"></script>
    <script>
        $(function () {

        })
    </script>
@endsection
