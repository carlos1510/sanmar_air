<div class="row" ng-show="estado_registro == 1">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registrar Reserva de Pasajes</h4>
            </div>
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                        <h4>Datos del Paciente</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
                                    <select class="form-control" data-trigger id="idtipodocumentocmb" placeholder="Seleccione" ng-change="tipo_busqueda_persona()" ng-model="registro.idtipo_documento">
                                        <option value="">---</option>
                                        <option value="1">DNI</option>
                                        <option value="2">CARNET DE EXTRANJERIA</option>
                                        <option value="3">PASAPORTE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltipUsername">Numero Documento <span class="text-danger">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="numerodocumentotxt" placeholder="" ng-model="registro.numero_documento" required>
                                        <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumento()"><i class="fas fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip01">Apellido Paterno <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="apellido_paternotxt" ng-model="registro.apellido_paterno" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip02">Apellido Materno <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="apellido_maternotxt"  ng-model="registro.apellido_materno" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip03">Nombres <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="nombrestxt" ng-model="registro.nombres" required>
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
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label>Edad <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control numero" id="edadtxt" ng-model="registro.edad" maxlength="2" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Telefono <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control numero" id="telefonotxt" maxlength="9" ng-model="registro.telefono" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Sexo</label>
                                    <select class="form-control" data-trigger id="sexocmb" placeholder="Seleccione" ng-model="registro.sexo">
                                        <option value="">---</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                        <h4>Datos del Pasaje</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <label>Servicios</label>
                                    <br>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" value="PASAJE AEREO" name="servicioRadios" ng-model="registro.tipo_servicio">
                                        <span class="form-radio-sign">PASAJE AEREO</span>
                                    </label>
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" value="VUELO CHARTER" name="servicioRadios" ng-model="registro.tipo_servicio">
                                        <span class="form-radio-sign">VUELO CHARTER</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <label>Vuelos</label>
                                    <br>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" value="IDA Y VUELTA" name="vuelosRadios" ng-model="registro.vuelos">
                                        <span class="form-radio-sign">Ida y Vuelta</span>
                                    </label>
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" value="SOLO IDA" name="vuelosRadios" ng-model="registro.vuelos">
                                        <span class="form-radio-sign">Sólo Ida</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Origen - Destino <span class="text-danger">(*)</span></label>
                                    <select class="form-control" data-trigger id="origen_destinocmb" placeholder="Seleccione" ng-model="registro.idruta_viaje_precio" >
                                        <option value="">---</option>
                                        <option ng-repeat="item in rutas" value="@{{ item.id }}">@{{ item.nom_ruta }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip04">Fecha Cita <span class="text-danger">(*)</span></label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input class="form-control " type="text" id="fecha_citatxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_cita">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip04">Fecha Salida</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input class="form-control " type="text" id="fecha_salidatxt" maxlength="10" autocomplete="off" placeholder="dd/mm/yyyy" ng-model="registro.fecha_salida">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="choices-single-default" class="form-label ">Tipo de Pasajero <span class="text-danger">(*)</span></label>
                                    <select class="form-control" data-trigger id="tipopasajerocmb" placeholder="Seleccione" ng-model="registro.tipo_pasajero" >
                                        <option value="">---</option>
                                        <option value="ADULTO">ADULTO</option>
                                        <option value="INFANTE">INFANTE</option>
                                        <option value="NIÑO">NIÑO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(Session::get('idnivel') == 1)
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group form-group-default">
                                        <label>Empresa: <span class="text-danger">(*)</span></label>
                                        <select id="empresacmb" class="form-control" ng-model="registro.idempresa">
                                            <option value="">----</option>
                                            <option ng-repeat="item in empresas" value="@{{ item.idempresa }}">@{{ item.razon_social }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-group-default">
                                        <label>Estado: <span class="text-danger">(*)</span></label>
                                        <select id="estadocmb" class="form-control" ng-model="registro.estado">
                                            <option value="">----</option>
                                            <option value="1">PENDIENTE</option>
                                            <option value="3">OBSERVADOS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-2 pl-3 pt-3 pr-3 pb-3 border-3 border-dark border-top border-bottom border-left border-right" style="border-radius: 5px !important;">
                        <h4>Datos Acompañante(s)
                            <button type="button" class="btn btn-icon btn-primary btn-round btn-sm" title="Agregar Acompañante" ng-click="addAcompanante()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </h4>
                        <div class="row" ng-repeat="item in registro.detalle_acompanante">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>DNI:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="" id="numero_documentotxt_@{{ $index }}" ng-model="item.numero_documento" required>
                                        <a href="javascript:void(0)" class="btn btn-primary" ng-click="buscarPersonaDocumentoAcomp($index, item)"><i class="fas fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="validationTooltip01">Apellido Paterno</label>
                                    <input type="text" class="form-control" ng-model="item.apellido_paterno" >
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="validationTooltip01">Apellido Materno</label>
                                    <input type="text" class="form-control" ng-model="item.apellido_materno" >
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="validationTooltip01">Nombres</label>
                                    <input type="text" class="form-control" ng-model="item.nombres" >
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label class="form-label" for="validationTooltip01">Edad</label>
                                    <input type="text" class="form-control" ng-model="item.edad" >
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="choices-single-default" class="form-label ">Tipo de Pasajero</label>
                                    <select class="form-control" data-trigger placeholder="Seleccione" ng-model="item.tipo_pasajero">
                                        <option value="">---</option>
                                        <option value="ADULTO">ADULTO</option>
                                        <option value="INFANTE">INFANTE</option>
                                        <option value="NIÑO">NIÑO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="text-center align-items-center justify-content-center" style="padding-top: 35px !important;">
                                    <button class="btn btn-icon btn-danger btn-round btn-sm" title="Quitar Acompañante" ng-click="removeAcompanante($index)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <label>Adjuntar Documentos</label> <button type="button" class="ml-2 btn btn-default btn-sm"><i class="flaticon-tool"></i> Agregar</button>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="file" class="file" />
                                            </td>
                                            <td>
                                                <div class="text-center align-items-center justify-content-center">
                                                    <button class="btn btn-danger btn-sm" title="Eliminar" ><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>--}}
                </form>
            </div>
            <div class="card-footer">
                <div class="text-center align-items-center justify-content-center">
                    <button class="btn btn-primary" type="button" ng-click="guardarPasaje()"><i class="fas fa-save"></i> GUARDAR</button>
                    <button class="btn btn-danger" type="button" ng-click="salir()"><i class="fas fa-times"></i> SALIR</button>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
</div>
