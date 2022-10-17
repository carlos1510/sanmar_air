/**
 * Created by carlo on 1/09/2018.
 */

app.controller('userController', function ($scope, $timeout, accesorioService, usuarioService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};
    $scope.filtro = {};
    $scope.lista = [];


    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.estado_registro = 1;
        /*$timeout(function () {
            $("#cmbProfesionalResponsable").val("").change();
            $("#cmbCod2000").val("").change();
            $("#cmbTipoVacuna").val("").change();
        }, 0)*/
    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
    }

    $scope.guardar = function () {
        var valid = validar_campo(['#fecha_vacunaciontxt','#fecha_recepciontxt','#numero_hojatxt','#cantidad_dosistxt']);
        if (valid){
            if ($scope.registro.detalle_vacuna.length > 0){
                vacunaCovidService.guardarRecepcionVacuna($scope.registro).success(function (data) {
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
                swal("Error!", "Debe ingresar al menos un registro del tipo de vacuna!", {
                    icon : "warning",
                    buttons: {
                        confirm: {
                            className : 'btn btn-warning'
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

    $scope.listar = function () {
        /*vacunaCovidService.listarRecepcionVacuna($scope.filtro).success(function (data) {
            $scope.lista = data;
        });*/
    }

    $scope.listar();

});
