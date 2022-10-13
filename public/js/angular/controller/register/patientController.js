
app.controller('patientController', function ($scope, $timeout, pacienteService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};
    $scope.filtro = {};
    $scope.lista = [];

    $scope.nuevoRegistro = function () {
        $scope.registro = {};

        $timeout(function () {
            $("#idtipodocumentocmb").val("1").change();
            $("#sexocmb").val("").change();
            $("#idcondicion_aseguradocmb").val("").change();
        }, 0);
        $scope.estado_registro = 1;

    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
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

    $scope.guardar = function (){
        var valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt']);
        if (valid){
            pacienteService.registrarPaciente($scope.registro).success(function (data) {
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

            })
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

    $scope.prepararEditar = function (item) {
        $scope.registro = item;
        $scope.estado_registro = 1;
        $timeout(function () {
            $("#idtipodocumentocmb").val(item.idtipo_documento).change();
            $("#sexocmb").val(item.sexo!=undefined?item.sexo:'').change();
            $("#idcondicion_aseguradocmb").val(item.idcondicion_asegurado!=undefined?item.idcondicion_asegurado:'').change();
        }, 0);
    }

    $scope.eliminarPaciente = function (item) {
        swal({
            title: 'Desea Eliminar?',
            text: "Se eliminará el paciente con numero de documento: " + item.numero_documento,
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
                pacienteService.eliminarPaciente({idpaciente: item.idpaciente}).success(function (data) {
                    if (data.confirm == true){
                        $scope.listar();
                        swal("Exito!", "Se elimino exitosamente!", {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
                    }
                })
            } else {
                //
            }
        });
    }

    $scope.listar = function () {
        pacienteService.listarPaciente({}).success(function (data) {
            $scope.lista = data;
        })
    }

    $scope.listar();
});
