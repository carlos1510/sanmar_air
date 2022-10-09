@extends('main')

@section('title')
    Usuarios
@endsection

@section('bodycontroller')
    id='userController' ng-controller='userController'
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Usuario</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Usuario</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Creación de Usuario </h4>
                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home2" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Persona</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile2" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Empresa</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="home2" role="tabpanel">
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
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip01">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip02">Apellido Materno</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
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
                                                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid city.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip04">Fecha Nacimiento</label>
                                                <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid state.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Sexo</label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder">
                                                    <option value="">---</option>
                                                    <option value="Choice 1">Choice 1</option>
                                                    <option value="Choice 2">Choice 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Telefono</label>
                                                <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid state.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Correo</label>
                                                <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid state.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Acceso: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder">
                                                    <option value="">---</option>
                                                    <option value="Choice 1">SI</option>
                                                    <option value="Choice 2">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Nivel de Usuario: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder">
                                                    <option value="">---</option>
                                                    <option value="Choice 1">Administrador</option>
                                                    <option value="Choice 2">--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip02">Usuario:</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltipUsername">Contraseña:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                                    <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                                    <div class="invalid-tooltip">
                                                        Please choose a unique and valid username.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">GUARDAR</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="profile2" role="tabpanel">
                                <form class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltipUsername">RUC.</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                                    <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip01">Razon social</label>
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Acceso: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder">
                                                    <option value="">---</option>
                                                    <option value="Choice 1">SI</option>
                                                    <option value="Choice 2">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Nivel de Usuario: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder">
                                                    <option value="">---</option>
                                                    <option value="Choice 1">Administrador</option>
                                                    <option value="Choice 2">--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip02">Usuario:</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltipUsername">Contraseña:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                                    <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                                    <div class="invalid-tooltip">
                                                        Please choose a unique and valid username.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">GUARDAR</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lista de Usuarios</h4>
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
                                <tr>
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
    <script src="js/angular/controller/setting/userController.js"></script>
@endsection
