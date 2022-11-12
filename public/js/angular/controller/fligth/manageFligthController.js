/**
 * Created by carlo on 1/09/2018.
 */

app.controller('manageFligthController', function ($scope, $timeout, empresaService, vuelosService, pacienteService, DTOptionsBuilder){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.estado_editar = 0;
    $scope.registro = {detalle_acompanante:[]};
    $scope.registro.detalle_personal = [];

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
        $timeout(function () {
            $("#estadobuscarcmb").val(1).change();
        }, 0);

        //$scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        //$scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();

    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
    }

    $scope.cambiarVuelos = function () {
        if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
            $scope.registro.vuelos = 'SOLO IDA';
        }else {
            $scope.registro.vuelos = 'IDA Y VUELTA';
        }
    }

    $scope.guardarPasaje = function () {
        var valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt','#edadtxt','#telefonotxt','#origen_destinocmb','#fecha_citatxt','#tipopasajerocmb','#empresacmb','#estadocmb']);
        if (valid){
            //var cantidad_item = ;
            for (var i = 0; i < $scope.rutas.length; i++){
                if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
                    if ($scope.rutas[i].id == $("#origen_destinocmb").val()){
                        if ($("#tipopasajerocmb").val() == 'ADULTO'){
                            $scope.registro.precio_unitario = $scope.rutas[i].precio_adulto_venta;
                        }else {
                            if ($("#tipopasajerocmb").val() == 'INFANTE'){
                                $scope.registro.precio_unitario = $scope.rutas[i].precio_infante_venta;
                            }else {
                                if ($("#tipopasajerocmb").val() == 'NIÑO'){
                                    $scope.registro.precio_unitario = $scope.rutas[i].precio_infante_venta;
                                }
                            }
                        }
                    }
                }else {
                    break;
                }
            }
            var valid_item = true;
            if ($scope.registro.detalle_acompanante.length > 0){
                for (var i = 0; i < $scope.registro.detalle_acompanante.length; i++){
                    if ($scope.registro.detalle_acompanante[i].nombres == ""){
                        valid_item = false;
                        break;
                    }
                }
                for (var i = 0; i < $scope.rutas.length; i++){
                    for (var j = 0; j < $scope.registro.detalle_acompanante.length; j++){
                        if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
                            if ($scope.rutas[i].id == $("#origen_destinocmb").val()){
                                if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'ADULTO'){
                                    $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_adulto_venta;
                                }else {
                                    if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'INFANTE'){
                                        $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_infante_venta;
                                    }else {
                                        if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'NIÑO'){
                                            $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_infante_venta;
                                        }
                                    }
                                }
                            }
                        }else {
                            break;
                        }
                    }

                }
            }

            var valid_item_personal = true;
            if ($scope.registro.detalle_personal.length > 0){
                for (var i = 0; i < $scope.registro.detalle_personal.length; i++){
                    if ($scope.registro.detalle_personal[i].nombres == ""){
                        valid_item_personal = false;
                        break;
                    }
                }
            }

            $scope.registro.tipo = $scope.registro.tipo_servicio=='PASAJE AEREO'?1:2;

            if (valid_item){
                const $archivos = document.querySelector("#archivos");
                let archivos = $archivos.files;
                let formdata = new FormData();
                // variables
                formdata.append('registro', JSON.stringify($scope.registro));
                if (archivos.length > 0 ){
                    // Agregar cada archivo al formdata
                    var i = 1;
                    angular.forEach(archivos, function (archivo) {
                        formdata.append('archivo_'+i, archivo);
                        i++;
                    });
                }
                let configuracion = {
                    headers: {
                        "Content-Type": undefined,
                    },
                    transformRequest: angular.identity,
                };

                $http
                    .post("vuelos/guardarPasajePaciente", formdata, configuracion)
                    .then(function (respuesta) {
                        if (respuesta.data.confirm == true){
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
                        //console.log("Después de enviar los archivos, el servidor dice:", respuesta.data);
                    })
                    .catch(function (detallesDelError) {
                        swal("Error!", "No se pudo completar el registro!", {
                            icon : "warning",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-warning'
                                }
                            },
                        });
                        //console.warn("Error al enviar archivos:", detallesDelError);
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

    $scope.eliminarPasaje = function (item) {
        swal({
            title: 'Desea Anular / Eliminar?',
            text: "Se eliminará el Pasaje del Paciente " + item.nombres,
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
                vuelosService.eliminarPasaje({idpasaje_paciente: item.idpasaje_paciente}).success(function (data) {
                    if (data.confirm == true){
                        $scope.listar();
                        swal("Exito!", "Se Elimino Exitosamente", {
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

    $scope.prepararVerObservacion = function (item) {
        $scope.registro = {};
        $scope.registro = item;
    }

    $scope.prepararAsignar = function (item) {
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
            $("#estadoAsignadocmb").val(item.estado).change();
            $("#empresaAsignarcmb").val(item.idempresa!=undefined?item.idempresa:'').change();
            $scope.estado_registro = 2;
        }, 100);
    }

    $scope.guardarAsignacion = function () {
        var valid = true;
        if ($("#estadocmb").val() == 2){
            valid = validar_campo(['#fecha_viajetxt','#precio_unitariotxt','#empresacmb']);
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

    $scope.addAcompanante = function () {
        $scope.registro.detalle_acompanante.push({idpersona: null,numero_documento: null, apellido_paterno: null, apellido_materno: null, nombres: null, edad: null, tipo_pasajero: '', precio_unitario: null, monto_empresa: null});
    }

    $scope.removeAcompanante = function (index) {
        $scope.registro.detalle_acompanante.splice(index, 1);
    }

    $scope.calcularEdadActual = function () {
        if($("#fecha_nacimientotxt").val()!=""){
            $scope.registro.edad = calculateAge($("#fecha_nacimientotxt").val());
        }
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
        $scope.estado_editar = 0;

    }

    $scope.buscarPersonaDocumentoAcomp = function (id, item) {
        if ($("#numero_documentotxt_"+id).val() != ""){
            pacienteService.buscarPersonaDocumento({idtipo_documento: 1, 'numero_documento': $("#numero_documentotxt_"+id).val()}).success(function (data) {
                item.numero_documento = data.data.numero_documento;
                item.apellido_paterno = data.data.apellido_paterno;
                item.apellido_materno = data.data.apellido_materno;
                item.nombres = data.data.nombres;
                item.idpersona = data.data.idpersona;
            })
        }
    }

    $scope.buscarPersonaDocumentoAcomp = function (id, item) {
        if ($("#numero_documentotxt_"+id).val() != ""){
            $scope.estado_busqueda_cliente = 1;
            pacienteService.buscarPersonaDocumento({idtipo_documento: 1, 'numero_documento': $("#numero_documentotxt_"+id).val()}).success(function (data) {
                item.numero_documento = data.data.numero_documento;
                item.apellido_paterno = data.data.apellido_paterno;
                item.apellido_materno = data.data.apellido_materno;
                item.nombres = data.data.nombres;
                item.idpersona = data.data.idpersona;
                $scope.estado_busqueda_cliente = 0;
            })
        }
    }

    $scope.addPersonalSalud = function () {
        $scope.registro.detalle_personal.push({idpersona: null,numero_documento: null, apellido_paterno: null, apellido_materno: null, nombres: null, edad: null, tipo_pasajero: '', precio_unitario: null});
    }

    $scope.removePersonalSalud = function (index) {
        $scope.registro.detalle_personal.splice(index, 1);
    }

    $scope.prepararEditar = function (item) {
        $scope.estado_editar = 1;
        $scope.registro = {};
        $scope.registro = item;
        $scope.registro.detalle_acompanante = [];
        vuelosService.obtenerListaAcompanantes({idpasaje_paciente: item.idpasaje_paciente}).success(function (data) {
            $scope.registro.detalle_acompanante = data;
        })
        $timeout(function () {
            $("#idtipodocumentocmb").val(item.idtipo_documento).change();
            $("#sexocmb").val(item.sexo).change();
            $("#origen_destinocmb").val(item.idruta_viaje_precio).change();
            $("#empresacmb").val(item.idempresa!=undefined?item.idempresa:'').change();
            $("#estadocmb").val(item.estado).change();
            $scope.estado_registro = 1;

        }, 0);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesReservados($scope.filtro).success(function (data) {
            $scope.lista = data;
        });
    }

    $scope.listarArchivos = function (id) {
        $scope.lista_documentos = [];
        vuelosService.obtenerDocumentosById({idpasaje_paciente: id}).success(function (data) {
            $scope.lista_documentos = data;
        })
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

    $scope.nuevo();

    $timeout(function () {
        $scope.listar();
    }, 200);

});
