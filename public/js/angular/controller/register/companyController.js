/**
 * Created by carlo on 1/09/2018.
 */

app.controller('companyController', function ($scope, $timeout, empresaService){
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

    $scope.listar = function () {
        empresaService.listarEmpresa($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.listar();

});
