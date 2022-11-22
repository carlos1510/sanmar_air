/**
 * Created by carlo on 1/09/2018.
 */

app.controller('fligthController', function ($scope, $http, $timeout, vuelosService, pacienteService, empresaService, DTOptionsBuilder){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.estado_editar = 0;
    $scope.estado_busqueda_cliente = 0;
    $scope.registro = {};
    $scope.registro.detalle_acompanante = [];
    $scope.registro.detalle_personal = [];
    $scope.rutas = [];
    $scope.files = [];

    $scope.filtro = {};
    $scope.lista = [];
    $scope.empresas = [];

    vuelosService.getRutasVuelos({}).success(function (data) {
        $scope.rutas = data;
    })

    empresaService.listarEmpresa({}).success(function (data) {
        $scope.empresas = data;
    });

    $scope.inicio = function () {
        var date = new Date();
        var primerDia = new Date(date.getFullYear(), date.getMonth() , 1);
        var ultimoDia = new Date(date.getFullYear(), (date.getMonth() + 1), 0);

        //$scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        //$scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();
        $timeout(function () {
            $("#estadobuscarcmb").val(1).change();
        }, 0);

    }

    $scope.nuevoRegistro = function () {
        $scope.registro = {};
        $scope.registro.detalle_acompanante = [];
        $scope.registro.detalle_personal = [];
        $scope.registro.tipo_servicio = 'PASAJE AEREO';
        $scope.registro.vuelos = 'SOLO IDA';
        $scope.registro.ida_retorno = 'IDA';

        $timeout(function () {
            $("#idtipodocumentocmb").val(1).change();
            $("#sexocmb").val('').change();
            $("#origen_destinocmb").val('').change();
            $("#tipopasajerocmb").val('').change();
        }, 0);

        vuelosService.generarCodigoTicket({}).success(function (data) {
            $scope.registro.codigo = data.codigo;
            $scope.registro.codigo_generado = data.codigo_generado;
        })

        $scope.estado_registro = 1;

    }

    $scope.calcularEdadActual = function () {
        if($("#fecha_nacimientotxt").val()!=""){
            $scope.registro.edad = calculateAge($("#fecha_nacimientotxt").val());
        }
    }

    $scope.cambiarVuelos = function () {
        if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
            $scope.registro.vuelos = 'SOLO IDA';
            $scope.registro.ida_retorno = 'IDA';
        }else {
            $scope.registro.vuelos = 'IDA Y VUELTA';
        }
    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
        $scope.registro.detalle_acompanante = [];
    }

    $scope.addAcompanante = function () {
        $scope.registro.detalle_acompanante.push({idpersona: null,numero_documento: null, apellido_paterno: null, apellido_materno: null, nombres: null, edad: null, tipo_pasajero: '', precio_unitario: null, monto_empresa: null});
    }

    $scope.removeAcompanante = function (index) {
        $scope.registro.detalle_acompanante.splice(index, 1);
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

    $scope.buscarPersonaDocumento = function () {
        if ($("#idtipodocumentocmb").val() != ""){
            if ($("#numerodocumentotxt").val() != ""){
                $scope.estado_busqueda_cliente = 1;
                pacienteService.buscarPersonaDocumento({idtipo_documento: $("#idtipodocumentocmb").val(), 'numero_documento': $("#numerodocumentotxt").val()}).success(function (data) {
                    $scope.registro.numero_documento = data.data.numero_documento;
                    $scope.registro.apellido_paterno = data.data.apellido_paterno;
                    $scope.registro.apellido_materno = data.data.apellido_materno;
                    $scope.registro.nombres = data.data.nombres;
                    $scope.registro.idpersona = data.data.idpersona;
                    $scope.estado_busqueda_cliente = 0;
                })
            }
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

    $scope.buscarPersonaDocumentoPersonal = function (id, item) {
        if ($("#numero_documentopstxt_"+id).val() != ""){
            $scope.estado_busqueda_cliente = 1;
            pacienteService.buscarPersonaDocumento({idtipo_documento: 1, 'numero_documento': $("#numero_documentopstxt_"+id).val()}).success(function (data) {
                item.numero_documento = data.data.numero_documento;
                item.apellido_paterno = data.data.apellido_paterno;
                item.apellido_materno = data.data.apellido_materno;
                item.nombres = data.data.nombres;
                item.idpersona = data.data.idpersona;
                $scope.estado_busqueda_cliente = 0;
            })
        }
    }

    $scope.guardarPasaje = function () {
        var valid = false;
        if ($scope.registro.ida_retorno == 'IDA' || $scope.registro.tipo_servicio=='VUELO CHARTER'){
            valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt','#edadtxt','#telefonotxt','#origen_destinocmb','#fecha_citatxt','#tipopasajerocmb']);
        }else {
            valid = validar_campo(['#idtipodocumentocmb','#numerodocumentotxt','#apellido_paternotxt','#apellido_maternotxt','#nombrestxt','#edadtxt','#telefonotxt','#origen_destinocmb','#tipopasajerocmb']);
        }

        if (valid){
            //var cantidad_item = ;
            for (var i = 0; i < $scope.rutas.length; i++){
                if ($scope.registro.tipo_servicio == 'PASAJE AEREO'){
                    if ($scope.rutas[i].id == $("#origen_destinocmb").val()){
                        if ($("#tipopasajerocmb").val() == 'ADULTO'){
                            $scope.registro.precio_unitario = $scope.rutas[i].precio_adulto_venta;
                            $scope.registro.monto_empresa = $scope.rutas[i].precio_adulto_compra;
                        }else {
                            if ($("#tipopasajerocmb").val() == 'INFANTE'){
                                $scope.registro.precio_unitario = $scope.rutas[i].precio_infante_venta;
                                $scope.registro.monto_empresa = $scope.rutas[i].precio_infante_compra;
                            }else {
                                if ($("#tipopasajerocmb").val() == 'NIÑO'){
                                    $scope.registro.precio_unitario = $scope.rutas[i].precio_ninio_venta;
                                    $scope.registro.monto_empresa = $scope.rutas[i].precio_ninio_compra;
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
                                    $scope.registro.detalle_acompanante[j].monto_empresa = $scope.rutas[i].precio_adulto_compra;
                                }else {
                                    if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'INFANTE'){
                                        $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_infante_venta;
                                        $scope.registro.detalle_acompanante[j].monto_empresa = $scope.rutas[i].precio_infante_compra;
                                    }else {
                                        if ($scope.registro.detalle_acompanante[j].tipo_pasajero == 'NIÑO'){
                                            $scope.registro.detalle_acompanante[j].precio_unitario = $scope.rutas[i].precio_ninio_venta;
                                            $scope.registro.detalle_acompanante[j].monto_empresa = $scope.rutas[i].precio_ninio_compra;
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
                                $scope.registro = {};
                                var archivo = document.getElementById('archivos');
                                archivo.value = '';
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
                    .catch(function (detallesDelError) {
                        swal("Error!", "No se pudo completar el registro!", {
                            icon : "warning",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-warning'
                                }
                            },
                        });
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

    $scope.eliminarViaje = function (item) {
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

    $scope.prepararEditar = function (item) {
        $scope.estado_editar = 1;
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
            $("#idtipodocumentocmb").val(item.idtipo_documento).change();
            $("#sexocmb").val(item.sexo).change();
            $("#origen_destinocmb").val(item.idruta_viaje_precio).change();
            $("#empresacmb").val(item.idempresa!=undefined?item.idempresa:'').change();
            $("#estadocmb").val(item.estado).change();
            $scope.estado_registro = 1;

        }, 50);
    }

    $scope.listar = function () {
        vuelosService.listarPasajesPaciente($scope.filtro).success(function (data) {
            $scope.lista = data;
        })
    }

    $scope.contarMarcados = function () {
        var contador = 0;
        for(var i=0; i < $scope.lista.length; i++){
            if ($scope.lista[i].check_imprimir == true){
                contador++;
            }
        }
        return contador;
    }

    $scope.marcarCheckBox = function () {
        for(var i=0; i < $scope.lista.length; i++){
            if ($scope.filtro.check_total == true){
                $scope.lista[i].check_imprimir = true;
            }else {
                $scope.lista[i].check_imprimir = false;
            }
        }
    }

    $scope.desmarcarTotalCheck = function (item) {
        var contador = 0;
        var cantidad = $scope.lista.length;
        if (item.check_imprimir == false){
            if ($scope.filtro.check_total == true){
                $scope.filtro.check_total = false;
            }
        }else {
            if (item.check_imprimir == true){
                for(var i=0; i < $scope.lista.length; i++){
                    if ($scope.lista[i].check_imprimir == true){
                        contador++;
                    }
                }
                if (contador == cantidad){
                    $scope.filtro.check_total = true;
                }else {
                    $scope.filtro.check_total = false;
                }
            }
        }
    }

    $scope.prepararRecibirPasaje = function (item) {
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
            $("#estadoRecibidocmb").val(2).change();
            $scope.estado_registro = 2;
        }, 100);
    }

    $scope.guardarRecibirPasaje = function () {
        var valid = true;
        valid = validar_campo(['#estadoRecibidocmb']);

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

    $scope.imprimirTickets = function () {
        var doc = new jsPDF("p","mm","a4");
        var indice = 0;
        for (var i = 0; i < $scope.lista.length; i++){
            if ($scope.lista[i].check_imprimir == true){
                if(indice != 0){
                    doc.addPage();
                }
                doc.setFontSize(10);
                doc.setFont('Verdana','bold');
                doc.text(70, 30, 'FENIX EMERGENCY GROUP EIRL');
                doc.text(80, 35, 'RUC: 20606397322');
                var codigo_generado = $scope.lista[i].codigo_generado!=undefined?$scope.lista[i].codigo_generado:'';
                doc.text(75, 40, 'Ticket Nro.: ' + codigo_generado);
                doc.line(55, 44, 140, 44, 'F');
                doc.setFont('Verdana','normal');
                doc.setFontSize(9);
                doc.text(55, 55, 'DNI:'); doc.text(65, 55, '' + $scope.lista[i].numero_documento);
                doc.text(55, 60, 'Nombres:');
                doc.text(72, 60, '' + $scope.lista[i].apellido_paterno + ' ' + $scope.lista[i].apellido_materno + ' ' + $scope.lista[i].nombres);
                doc.text(55, 65, 'Edad:'); doc.text(68, 65, '' + $scope.lista[i].edad);
                doc.text(55, 70, 'Tipo de Pasajero:'); doc.text(83, 70, '' + $scope.lista[i].tipo_pasajero);
                doc.text(55, 75, 'Pasajero:'); doc.text(72, 75, '' + $scope.lista[i].tipo_paciente);
                doc.text(55, 80, 'Servicio:'); doc.text(70, 80, '' + $scope.lista[i].tipo_servicio);
                doc.text(55, 87, '-------------------------------------------------------------------------------');
                doc.text(55, 90, 'Origen'); doc.text(85, 90, 'Destino'); doc.text(115, 90, 'Fecha Cita');
                doc.text(55, 93, '-------------------------------------------------------------------------------');
                doc.text(55, 98, '' + $scope.lista[i].origen); doc.text(85, 98, '' + $scope.lista[i].destino); doc.text(115, 98, '' + $scope.lista[i].fecha_cita);
                doc.text(55, 102, '-------------------------------------------------------------------------------');
                doc.text(55, 107, 'Estado: ' + $scope.lista[i].nom_estado);
                indice++;
            }
        }

        //doc.autoPrint({variant: 'non-conform'});
        doc.save('ticket.pdf');

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

    $scope.inicio();
    $timeout(function () {
        $scope.listar();
    }, 200);

});
