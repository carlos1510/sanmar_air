/**
 * Created by carlo on 1/09/2018.
 */

app.controller('fligthController', function ($scope, $timeout, vuelosService, pacienteService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};
    $scope.registro.detalle_acompanante = [];
    $scope.rutas = [];

    $scope.filtro = {};
    $scope.lista = [];

    vuelosService.getRutasVuelos({}).success(function (data) {
        $scope.rutas = data;
    })

    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.registro.detalle_acompanante = [];
        $scope.registro.tipo_servicio = 'VUELOS';
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
        $scope.registro.detalle_acompanante.push({idpersona: null,numero_documento: null, apellido_paterno: null, apellido_materno: null, nombres: null, edad: null, tipo_pasajero: ''});
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
            })
        }
    }

    $scope.guardar = function () {
        var valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt','#edadtxt','#telefonotxt','#origen_destinocmb','#fecha_citatxt','#tipopasajerocmb']);
        if (valid){
            //var cantidad_item = ;
            var valid_item = true;
            if ($scope.registro.detalle_acompanante.length > 0){
                for (var i = 0; i < $scope.registro.detalle_acompanante.length; i++){
                    if ($scope.registro.detalle_acompanante[i].nombres == ""){
                        valid_item = false;
                        break;
                    }
                }
            }

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
        vuelosService.listarPasajesPaciente($scope.buscar).success(function (data) {
            $scope.lista = data;
        })
    }

    $scope.listar();

});
