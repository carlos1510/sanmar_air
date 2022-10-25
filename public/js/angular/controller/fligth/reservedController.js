/**
 * Created by carlo on 1/09/2018.
 */

app.controller('reservedController', function ($scope, $timeout, vuelosService){
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
        var valid = true;
        if ($("#estadocmb").val() == 2){
            valid = validar_campo(['#fecha_viajetxt','#montotxt']);
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
        $scope.registro.detalle_acompanante = [];
        vuelosService.obtenerListaAcompanantes({idpasaje_paciente: item.idpasaje_paciente}).success(function (data) {
            $scope.registro.detalle_acompanante = data;
        })
        $timeout(function () {
            $("#estadocmb").val(item.estado==1?2:item.estado).change();
            $scope.estado_registro = 1;
        }, 100);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesReservadosEmpresa($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.listar();

});
