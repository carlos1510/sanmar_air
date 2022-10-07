/**
 * Created by carlo on 1/09/2018.
 */

app.controller('homeController', function ($scope, $timeout, DTOptionsBuilder, accesorioService, vacunaCovidService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.anios = [];
    $scope.meses = [];

    $scope.estado_registro = 0;
    $scope.registro = {detalle_vacuna: []};
    $scope.establecimientos = [];
    $scope.profesionales = [];
    $scope.filtro = {};
    $scope.lista = [];


    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.registro.detalle_vacuna = [];
        $scope.estado_registro = 1;
        $timeout(function () {
            $("#cmbProfesionalResponsable").val("").change();
            $("#cmbCod2000").val("").change();
            $("#cmbTipoVacuna").val("").change();
        }, 0)
    }

    accesorioService.getEESS({codigo_red: '01'}).success(function (data) {
        $scope.establecimientos = data;
    });

    vacunaCovidService.listarProfesionalVacunaRed({}).success(function (data) {
        $scope.profesionales = data;
    });

    $scope.salir = function () {
        $scope.estado_registro = 0;
    }

    $scope.agregarItem = function () {
        $scope.registro.detalle_vacuna.push({tipo_vacuna: "", lote_vacuna: "", cantidad_dosis_aplicada: null});
    }

    $scope.quitarDetalle = function (index) {
        $scope.registro.detalle_vacuna.splice(index, 1);
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
        vacunaCovidService.listarRecepcionVacuna($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.elementos.dtOptions = DTOptionsBuilder.newOptions().withPaginationType('full_numbers').withLanguage({
        "sEmptyTable": "No hay Datos Disponibles",
        "sInfo": "Mostrando _START_ hasta _END_ de _TOTAL_ Filas",
        "sInfoEmpty": "Viendo 0 hasta 0 de 0 filas",
        "sInfoFiltered": "(filtrado de _MAX_ Filas)",
        "sInfoPostFix": "",
        "sInfoThousands": ",",
        "sLengthMenu": "Ver _MENU_ Filas",
        "sLoadingRecords": "Cargando...",
        "sProcessing": "Procesando...",
        "sSearch": "Buscar:",
        "sZeroRecords": "No se encontraron registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ultimo",
            "sNext": ">>",
            "sPrevious": "<<"
        },
        "oAria": {
            "sSortAscending": ": activado para ordenar columna ascendente",
            "sSortDescending": ": activado para ordenar columna descendente"
        }
    }).withOption('order', [0, 'asc'])
        .withOption('lengthMenu',[[15,25,50],[15,25,50]])
        .withOption('processing', true);

    $scope.redrawDT = function(){
        $scope.$emit('event:dataTableLoaded');
    }

    $scope.$on("event:dataTableLoaded", function(event, loadedDT) {
        $scope.dtInstance.DataTable.draw();
    });

    $scope.listar();

});
