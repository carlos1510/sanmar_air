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
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Nivel de Usuario: <span class="text-danger">(*)</span> </label>
                                        <select class="form-control" data-trigger name="choices-single-default" id="nivelusuariocmb" ng-change="tipoNivelUsuario()" ng-model="registro.idnivel" >
                                            <option value="">---</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">EsSalud</option>
                                            <option value="3">Empresa</option>
                                            <option value="4">Secretaria</option>
                                            <option value="5">Establecimiento</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Acceso: <span class="text-danger">(*)</span></label>
                                        <select class="form-control" data-trigger name="choices-single-default" id="accesocmb" placeholder="This is a search placeholder" ng-model="registro.acceso">
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
                                            <input type="password" class="form-control" ng-model="registro.password" id="txtPassword">
                                            <button class="btn btn-info" type="button" ng-click="mostrarPass()"><i id="icon" class="fas fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Tipo Documento: <span class="text-danger">(*)</span></label>
                                        <select class="form-control" data-trigger name="choices-single-default" id="idtipodocumentocmb" ng-change="tipo_busqueda_persona()" ng-model="registro.idtipo_documento">
                                            <option value="">---</option>
                                            <option value="1">DNI</option>
                                            <option value="2">CARNET DE EXTRANJERIA</option>
                                            <option value="3">PASAPORTE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Numero Documento: <span class="text-danger">(*)</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="numerodocumentotxt" ng-model="registro.numero_documento" required>
                                            <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumento()"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">Apellido Paterno: <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="apellido_paternotxt" ng-model="registro.apellido_paterno" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">Apellido Materno: <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="apellido_maternotxt" ng-model="registro.apellido_materno" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">Nombres: <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="nombrestxt" ng-model="registro.nombres" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">Fecha Nacimiento: </label>
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
                                        <label for="choices-single-default" class="form-label ">Sexo: </label>
                                        <select class="form-control" data-trigger name="choices-single-default"
                                                id="sexocmb" placeholder="Seleccione el Sexo" ng-model="registro.sexo">
                                            <option value="">---</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Telefono: </label>
                                        <input type="text" class="form-control numero" id="validationTooltip04" maxlength="9" ng-model="registro.telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 ">
                                        <label for="choices-single-default" class="form-label ">Correo: </label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                            <input type="text" class="form-control" id="validationTooltipUsername" ng-model="registro.correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7" ng-show="estado_visible_empresa == 1">
                                    <div class="mb-3 ">
                                        <label for="choices-empresa" class="form-label ">Empresa: </label>
                                        <select class="form-control" data-trigger name="choices-empresa" id="idempresacmb" ng-model="registro.idempresa">
                                            <option value="">---</option>
                                            <option ng-repeat="item in empresas" value="@{{ item.idempresa }}">@{{ item.razon_social }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="text-center align-items-center justify-content-center">
                            <button class="btn btn-success btn-sm" ng-click="guardar()"  title="Guardar"><i class="fas fa-save"></i> Guardar</button>
                            <button class="btn btn-danger btn-sm" ng-click="salir()" title="Salir"><i class="fas fa-times"></i> Salir</button>
                        </div>
                    </div>
                </div>
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
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <th>#</th>
                                <th>Nro. Doc.</th>
                                <th>Nombre del Usuario</th>
                                <th>Acceso</th>
                                <th>Nivel</th>
                                <th>Usuario</th>
                                <th>Empresa</th>
                                <th>Acción</th>
                                </thead>
                                <tbody>
                                <tr ng-repeat="item in lista">
                                    <td>@{{ $index + 1 }}</td>
                                    <td>@{{ item.numero_documento }}</td>
                                    <td>@{{ item.apellido_paterno }} @{{ item.apellido_materno }} @{{ item.nombres }}</td>
                                    <td class="text-center"><span class="pl-3 " ng-class="{'text-primary': item.acceso==1, 'text-danger': item.acceso==0}">@{{ item.nom_acceso }}</span></td>
                                    <td>@{{ item.nivel }}</td>
                                    <td>@{{ item.usuario }}</td>
                                    <td>@{{ item.razon_social }}</td>

                                    <td>
                                        <button class="btn btn-success btn-sm" ng-click="prepararEditar(item)" title="Editar"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" ng-click="eliminarUsuario(item)" title="Eliminar"><i class="fas fa-times"></i></button>
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
    <script src="assets/js/pages/pass-addon.init.js"></script>
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
