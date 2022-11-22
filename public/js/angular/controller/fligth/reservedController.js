/**
 * Created by carlo on 1/09/2018.
 */

app.controller('reservedController', function ($scope, $timeout, vuelosService, DTOptionsBuilder){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};

    $scope.filtro = {};
    $scope.lista = [];

    $timeout(function () {
        var date = new Date();
        var primerDia = new Date(date.getFullYear(), date.getMonth() , 1);
        var ultimoDia = new Date(date.getFullYear(), (date.getMonth() + 1), 0);

        //$scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        //$scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();
        $("#estado_busquedacmb").val(2).change();
    },0);

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
        vuelosService.obtenerListaPersonalSalud({idpasaje_paciente: item.idpasaje_paciente}).success(function (data) {
            $scope.registro.detalle_personal = data;
        })
        $timeout(function () {
            $("#estadocmb").val(item.estado==1?3:item.estado).change();
            $scope.estado_registro = 1;
        }, 100);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesReservadosEmpresa($scope.filtro).success(function (data) {
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
        .withOption('lengthMenu',[[50,100],[50,100]])
        .withOption('processing', true);
    /*.withButtons([
     {
     extend: "excelHtml5",
     filename:  "Nominal",
     title:"LISTADO DE NOMINAL",
     exportOptions: {
     columns: ':visible'
     },
     //CharSet: "utf8",
     exportData: { decodeEntities: true }
     }
     ]);*/
    $scope.redrawDT = function(){
        $scope.$emit('event:dataTableLoaded');
    }

    $scope.$on("event:dataTableLoaded", function(event, loadedDT) {
        $scope.dtInstance.DataTable.draw();
    });

    $timeout(function () {
        $scope.listar();
    }, 200);

});
