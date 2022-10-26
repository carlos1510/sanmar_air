/**
 * Created by carlo on 1/09/2018.
 */

app.controller('manageFligthController', function ($scope, $timeout, empresaService, vuelosService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};

    $scope.filtro = {};
    $scope.lista = [];
    $scope.rutas = [];
    $scope.empresas = [];

    empresaService.listarEmpresa({}).success(function (data) {
        $scope.empresas = data;
    });

    vuelosService.getRutasVuelos({}).success(function (data) {
        $scope.rutas = data;
    });

    $scope.nuevo = function () {
        var date = new Date();
        var primerDia = new Date(date.getFullYear(), date.getMonth() , 1);
        var ultimoDia = new Date(date.getFullYear(), (date.getMonth() + 1), 0);

        $scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        $scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();

    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
    }

    $scope.guardar = function () {
        var valid = validar_campo(['#ructxt','#razonsocialtxt']);
        if (valid){
            empresaService.registrarEmpresa($scope.registro).success(function (data) {
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

    $scope.eliminarEmpresa = function (item) {
        swal({
            title: 'Desea Eliminar?',
            text: "Se eliminará la empresa " + item.razon_social,
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
                empresaService.eliminarEmpresa({id: item.idempresa}).success(function (data) {
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
                })
            } else {
                //
            }
        });
    }

    $scope.prepararAsignar = function (item) {
        $scope.registro = {};
        $scope.registro = item;
        $scope.registro.detalle_acompanante = [];
        vuelosService.obtenerListaAcompanantes({idpasaje_paciente: item.idpasaje_paciente}).success(function (data) {
            $scope.registro.detalle_acompanante = data;
        })
        $timeout(function () {
            $("#estadocmb").val(item.estado==1?2:item.estado).change();
            $("#empresacmb").val(item.idempresa!=undefined?item.idempresa:'').change();
            $scope.estado_registro = 2;
        }, 100);
    }

    $scope.guardarAsignacion = function () {
        var valid = true;
        if ($("#estadocmb").val() == 2){
            valid = validar_campo(['#fecha_viajetxt','#montotxt','#empresacmb']);
        }

        if (valid){
            vuelosService.guardarConfirmarReservaPasaje($scope.registro).success(function (data) {
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
        $scope.registro = {};
        $scope.registro = item;
        $timeout(function () {
            $("#idtipodocumentocmb").val(item.idtipo_documento).change();
            $("#sexocmb").val(item.sexo).change();
            $("#origen_destinocmb").val(item.idruta_viaje_precio).change();
            $scope.estado_registro = 1;
        }, 0);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesReservados($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.nuevo();

    $scope.listar();

});
