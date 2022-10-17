@extends('main')

@section('title')
    Usuarios
@endsection

@section('bodycontroller')
    id='userController' ng-controller='userController'
@endsection

@section('container-header')
    <div class="page-header">
        <h4 class="page-title">Usuarios</h4>
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
                <a href="#">Usuarios</a>
            </li>
        </ul>
    </div>
@endsection


@section('content')
    <div class="container-fluid">

        <div class="row" ng-show="estado_registro == 1">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Creación de Usuario </h4>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="home2" role="tabpanel">
                                <form class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Nivel de Usuario: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder" ng-model="registro.idnivel">
                                                    <option value="">---</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">EsSalud</option>
                                                    <option value="3">Empresa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Acceso: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder" ng-model="registro.acceso">
                                                    <option value="">---</option>
                                                    <option value="1">SI</option>
                                                    <option value="0">NO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip02">Usuario:</label>
                                                <input type="text" class="form-control" id="validationTooltip02" ng-model="registro.usuario">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltipUsername">Contraseña:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-user-lock"></i></span>
                                                    <input type="password" class="form-control" id="validationTooltipUsername" ng-model="registro.password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
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
                                                    <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.numero_documento" required>
                                                    <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
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
                                                <input type="text" class="form-control" id="validationTooltip02" ng-model="registro.apellido_materno" required>
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
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Sexo</label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="sexocmb" placeholder="Seleccione el Sexo" ng-model="registro.sexo">
                                                    <option value="">---</option>
                                                    <option value="MASCULINO">Masculino</option>
                                                    <option value="FEMENINO">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Telefono</label>
                                                <input type="text" class="form-control numero" id="validationTooltip04" maxlength="9" ng-model="registro.telefono">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Correo</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                                    <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.correo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Empresa</label>
                                                <select class="form-control" data-trigger name="choices-single-default" id="idempresacmb"
                                                        placeholder="Seleccione la empresa" ng-model="registro.idempresa">
                                                    <option value="">---</option>
                                                </select>
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
                                                    <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.ruc" required>
                                                    <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip01">Razon social</label>
                                                <input type="text" class="form-control" id="validationTooltip01" ng-model="registro.razon_social" required>
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
                                                        placeholder="This is a search placeholder" ng-model="registro.acceso">
                                                    <option value="">---</option>
                                                    <option value="1">SI</option>
                                                    <option value="0">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 ">
                                                <label for="choices-single-default" class="form-label ">Nivel de Usuario: </label>
                                                <select class="form-control" data-trigger name="choices-single-default"
                                                        id="choices-single-default"
                                                        placeholder="This is a search placeholder" ng-model="registro.idnivel">
                                                    <option value="">---</option>
                                                    <option value="3">--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="validationTooltip02">Usuario:</label>
                                                <input type="text" class="form-control" id="validationTooltip02" ng-model="registro.usuario">
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
                                                    <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.password">
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

        <div class="row" ng-show="estado_registro == 0">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <h4 class="card-title">Lista de Usuarios</h4>
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
    <script src="js/angular/controller/setting/userController.js"></script>
    <script>
        $(function (){
            $(".numero").numeric({decimal: false, negative: false});
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
