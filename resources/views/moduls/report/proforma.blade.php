@extends('main')

@section('title')
    Proforma
@endsection

@section('bodycontroller')
    id='proformaController' ng-controller='proformaController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Proforma</h4>
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
                <a href="#">Proforma</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="row" ng-show="estado_registro == 0">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Reporte de Proformas - Pasajes</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ruta Origen - Destino</label>
                                <select class="form-control" placeholder="Seleccione">
                                    <option value="">TODOS</option>
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
                    </div>
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
    <script src="js/angular/controller/report/proformaController.js"></script>
    <script>
        $(function () {
            $(".numero").numeric({decimal: false, negative: false});
        })
    </script>
@endsection
