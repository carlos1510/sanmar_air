/**
 * Created by carlo on 1/09/2018.
 */

app.controller('manageFligthController', function ($scope, $timeout, empresaService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};

    $scope.filtro = {};
    $scope.lista = [];

    $scope.nuevoRegistro = function () {
        $scope.registro = {};

        $scope.estado_registro = 1;

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

    $scope.prepararEditar = function (item) {
        $scope.registro = {};
        $scope.registro = item;
        $timeout(function () {
            $scope.estado_registro = 1;
        }, 0);
    }

    $scope.listar = function () {
        empresaService.listarEmpresa($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.listar();

});
