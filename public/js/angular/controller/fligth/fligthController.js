/**
 * Created by carlo on 1/09/2018.
 */

app.controller('fligthController', function ($scope, $timeout, vuelosService, pacienteService, empresaService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};
    $scope.registro.detalle_acompanante = [];
    $scope.rutas = [];

    $scope.filtro = {};
    $scope.lista = [];
    $scope.empresas = [];

    vuelosService.getRutasVuelos({}).success(function (data) {
        $scope.rutas = data;
    })

    empresaService.listarEmpresa({}).success(function (data) {
        $scope.empresas = data;
    });

    $scope.inicio = function () {
        var date = new Date();
        var primerDia = new Date(date.getFullYear(), date.getMonth() , 1);
        var ultimoDia = new Date(date.getFullYear(), (date.getMonth() + 1), 0);

        //$scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        //$scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();
        $timeout(function () {
            $("#estadobuscarcmb").val(1).change();
        }, 0);

    }

    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.registro.detalle_acompanante = [];
        $scope.registro.tipo_servicio = 'PASAJE AEREO';
        $scope.registro.vuelos = 'IDA Y VUELTA';

        $timeout(function () {
            $("#idtipodocumentocmb").val(1).change();
            $("#sexocmb").val('').change();
            $("#origen_destinocmb").val('').change();
            $("#tipopasajerocmb").val('').change();
        }, 0);

        $scope.estado_registro = 1;

    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
        $scope.registro.detalle_acompanante = [];
    }

    $scope.addAcompanante = function () {
        $scope.registro.detalle_acompanante.push({idpersona: null,numero_documento: null, apellido_paterno: null, apellido_materno: null, nombres: null, edad: null, tipo_pasajero: '', precio_unitario: null});
    }

    $scope.removeAcompanante = function (index) {
        $scope.registro.detalle_acompanante.splice(index, 1);
    }

    $scope.tipo_busqueda_persona = function () {
        if ($("#idtipodocumentocmb").val() != ""){
            if ($("#idtipodocumentocmb").val() == 1){
                $timeout(function () {
                    $('#numerodocumentotxt').val("");
                    $("#numerodocumentotxt").addClass( 'numero_dni' );
                    $("#numerodocumentotxt").attr('maxlength', 8);
                    $(".numero_dni").numeric({decimal: false, negative: false});
                    $("#nro_documentotxt").focus();
                }, 100);
            }else {
                $timeout(function () {
                    $('#numerodocumentotxt').val("");
                    $("#numerodocumentotxt").attr('maxlength', 12);
                    $(".numero_dni").removeNumeric();
                    $("#numerodocumentotxt").focus();
                }, 100);
            }
        }
    }

    $scope.buscarPersonaDocumento = function () {
        if ($("#idtipodocumentocmb").val() != ""){
            if ($("#numerodocumentotxt").val() != ""){
                pacienteService.buscarPersonaDocumento({idtipo_documento: $("#idtipodocumentocmb").val(), 'numero_documento': $("#numerodocumentotxt").val()}).success(function (data) {
                    $scope.registro.numero_documento = data.data.numero_documento;
                    $scope.registro.apellido_paterno = data.data.apellido_paterno;
                    $scope.registro.apellido_materno = data.data.apellido_materno;
                    $scope.registro.nombres = data.data.nombres;
                    $scope.registro.idpersona = data.data.idpersona;
                })
            }
        }
    }

    $scope.buscarPersonaDocumentoAcomp = function (id, item) {
        //console.log(id);
        if ($("#numero_documentotxt_"+id).val() != ""){
            pacienteService.buscarPersonaDocumento({idtipo_documento: 1, 'numero_documento': $("#numero_documentotxt_"+id).val()}).success(function (data) {
                item.numero_documento = data.data.numero_documento;
                item.apellido_paterno = data.data.apellido_paterno;
                item.apellido_materno = data.data.apellido_materno;
                item.nombres = data.data.nombres;
                item.idpersona = data.data.idpersona;
            })
        }
    }

    $scope.guardarPasaje = function () {
        var valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt','#edadtxt','#telefonotxt','#origen_destinocmb','#fecha_citatxt','#tipopasajerocmb']);
        if (valid){
            //var cantidad_item = ;
            for (var i = 0; i < $scope.rutas.length; i++){
                if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
                    if ($scope.rutas[i].id == $("#origen_destinocmb").val()){
                        if ($("#tipopasajerocmb").val() == 'ADULTO'){
                            $scope.registro.precio_unitario = $scope.rutas[i].precio_adulto;
                        }else {
                            if ($("#tipopasajerocmb").val() == 'INFANTE'){
                                $scope.registro.precio_unitario = $scope.rutas[i].precio_infante;
                            }else {
                                if ($("#tipopasajerocmb").val() == 'NIÑO'){
                                    $scope.registro.precio_unitario = $scope.rutas[i].precio_infante;
                                }
                            }
                        }
                    }
                }else {
                    break;
                }
            }
            var valid_item = true;
            if ($scope.registro.detalle_acompanante.length > 0){
                for (var i = 0; i < $scope.registro.detalle_acompanante.length; i++){
                    if ($scope.registro.detalle_acompanante[i].nombres == ""){
                        valid_item = false;
                        break;
                    }
                }
                for (var i = 0; i < $scope.rutas.length; i++){
                    for (var j = 0; j < $scope.registro.detalle_acompanante.length; j++){
                        if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
                            if ($scope.rutas[i].id == $("#origen_destinocmb").val()){
                                if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'ADULTO'){
                                    $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_adulto;
                                }else {
                                    if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'INFANTE'){
                                        $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_infante;
                                    }else {
                                        if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'NIÑO'){
                                            $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_infante;
                                        }
                                    }
                                }
                            }
                        }else {
                            break;
                        }
                    }

                }
            }

            $scope.registro.tipo = $scope.registro.tipo_servicio=='PASAJE AEREO'?1:2;

            if (valid_item){
                vuelosService.guardarPasajePaciente($scope.registro).success(function (data) {
                    if (data.confirm == true){
                        swal("Exito!", "Se registro correctamente la información!", {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
                        $timeout(function () {
                            $scope.estado_registro = 0;
                            $scope.listar();
                        }, 0);
                    }else {
                        swal("Error!", "No se pudo completar el registro!", {
                            icon : "warning",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-warning'
                                }
                            },
                        });
                    }
                });
            }else {
                swal("Error!", "Campos obligatorios!", {
                    icon : "danger",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            }
        }else {
            swal("Error!", "Campos obligatorios!", {
                icon : "danger",
                buttons: {
                    confirm: {
                        className : 'btn btn-danger'
                    }
                },
            });
        }
    }

    $scope.eliminarViaje = function (item) {
        swal({
            title: 'Desea Eliminar?',
            text: "Se eliminará el Vuelo del Paciente " + item.nombres,
            icon : "warning",
            type: 'warning',
            buttons:{
                confirm: {
                    text : 'Eliminar',
                    className : 'btn btn-warning'
                },cancel: {
                    visible: true,
                    text : 'Cancelar',
                    className: 'btn btn-danger'
                }
            }
        }).then(function(willDelete) {
            if (willDelete) {
                //registramos los datos
                /*empresaService.eliminarEmpresa({id: item.idempresa}).success(function (data) {
                    if (data.confirm == true){
                        $scope.listar();
                        swal("Exito!", "" + data.message, {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
                    }
                })*/
            } else {
                //
            }
        });
    }

    $scope.prepararEditar = function (item) {
        $scope.registro = {};
        $scope.registro = item;
        $timeout(function () {
            $scope.estado_registro = 1;
        }, 0);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesPaciente($scope.filtro).success(function (data) {
            $scope.lista = data;
        })
    }

    $scope.inicio();
    $timeout(function () {
        $scope.listar();
    }, 200);

});
