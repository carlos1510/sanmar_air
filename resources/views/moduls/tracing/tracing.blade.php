@extends('main')

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

        <div class="row">
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
                                                placeholder="This is a search placeholder">
                                            <option value="">---</option>
                                            <option value="Choice 1">Choice 1</option>
                                            <option value="Choice 2">Choice 2</option>
                                            <option value="Choice 3">Choice 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Numero Documento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">Paciente</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
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
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
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
                                                placeholder="This is a search placeholder">
                                            <option value="">---</option>
                                            <option value="Choice 1">Choice 1</option>
                                            <option value="Choice 2">Choice 2</option>
                                            <option value="Choice 3">Choice 3</option>
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

        <div class="row">
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
                                        <textarea class="form-control"></textarea>
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

        <div class="row">
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
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Hora: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Costo: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Nro. Boleto: </label>
                                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
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
                                <tr>
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
@endsection
