/**
 * Created by carlo on 1/09/2018.
 */

app.controller('userController', function ($scope, $timeout, usuarioService, pacienteService, empresaService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.estado_visible_empresa = 0;
    $scope.estado_editar = 0;
    $scope.registro = {};
    $scope.filtro = {};
    $scope.lista = [];
    $scope.empresas = [];

    empresaService.listarEmpresa({}).success(function (data) {
        $scope.empresas = data;
    })

    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.estado_registro = 1;
        $scope.estado_editar = 0;
        $scope.estado_visible_empresa = 0;
        $timeout(function () {
            $("#idtipodocumentocmb").val(1).change();
            $("#sexocmb").val('').change();
            $("#idempresacmb").val("").change();
        }, 0);
    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
        $scope.estado_editar = 0;
        $scope.estado_visible_empresa = 0;
    }

    $scope.tipo_busqueda_persona = function () {
        if ($scope.estado_editar == 0){
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
        $timeout(function () {
            $scope.estado_editar = 0;
        }, 100);
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

    $scope.tipoNivelUsuario = function () {
        if ($("#nivelusuariocmb").val() != ""){
            if ($("#nivelusuariocmb").val() == 3){
                $timeout(function () {
                    $scope.estado_visible_empresa = 1;
                }, 0);
            }else {
                $timeout(function () {
                    $("#idempresacmb").val("").change();
                    $scope.estado_visible_empresa = 0;
                }, 0);
            }
        }else {
            $timeout(function () {
                $("#idempresacmb").val("").change();
                $scope.estado_visible_empresa = 0;
            }, 0);
        }
    }

    $scope.guardar = function () {
        var valid = validar_campo(['#nivelusuariocmb','#accesocmb','#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt']);
        if (valid){
            usuarioService.registrarUsuario($scope.registro).success(function (data) {
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
        $scope.estado_visible_empresa = item.idempresa!=undefined?1:0;
        $scope.estado_registro = 1;
        $scope.estado_editar = 1;
        $timeout(function () {
            $("#idtipodocumentocmb").val(item.idtipo_documento!=undefined?item.idtipo_documento:'').change();
            $("#sexocmb").val(item.sexo!=undefined?item.sexo:'').change();
            $("#idempresacmb").val(item.idempresa!=undefined?item.idempresa:'').change();
            $("#nivelusuariocmb").val(item.idnivel!=undefined?item.idnivel:'').change();
            $("#accesocmb").val(item.acceso!=undefined?item.acceso:'').change();
        }, 0);
    }

    $scope.listar = function () {
        usuarioService.listarUsuarios({}).success(function (data) {
            $scope.lista = data;
        })
    }

    $scope.eliminarUsuario = function (item) {
        swal({
            title: 'Desea Eliminar?',
            text: "Se eliminará el usuario " + item.nombres,
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
                usuarioService.eliminarUsuario({idusuario: item.idusuario}).success(function (data) {
                    if (data.confirm == true){
                        $scope.listar();
                        swal("Exito!", "Eliminado Exitosamente", {
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

    $scope.mostrarPass = function () {
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('#icon').removeClass('fas fa-eye-slash').addClass('fas fa-eye');
        }else{
            cambio.type = "password";
            $('#icon').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        }
    }

    $scope.listar();

});
