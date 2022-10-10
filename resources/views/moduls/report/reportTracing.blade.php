@extends('main')

@section('title')
    Reporte Seguimiento
@endsection

@section('bodycontroller')
    id='reportTracingController' ng-controller='reportTracingController'
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Reporte Seguimiento</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item ">Reportes</li>
                            <li class="breadcrumb-item active">Reporte Seguimiento</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
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
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Fecha Inicio: </label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Fecha Final: </label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Destino: </label>
                                    <select class="form-control" data-trigger name="choices-single-default"
                                            id="choices-single-default"
                                            placeholder="This is a search placeholder">
                                        <option value="">---</option>
                                        <option value="Choice 1">Choice 1</option>
                                        <option value="Choice 2">Choice 2</option>
                                        <option value="Choice 3">Choice 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Empresa: </label>
                                    <select class="form-control" data-trigger name="choices-single-default"
                                            id="choices-single-default"
                                            placeholder="This is a search placeholder">
                                        <option value="">---</option>
                                        <option value="Choice 1">Choice 1</option>
                                        <option value="Choice 2">Choice 2</option>
                                        <option value="Choice 3">Choice 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                        <button type="button" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar</button>
                    </div>
                    <div class="card-footer p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <th>#</th>
                                <th>Unidad</th>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Cant.</th>
                                <th>Prec. Unit.</th>
                                <th>Total</th>
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
    <script src="js/angular/controller/report/reportTracingController.js"></script>
@endsection
