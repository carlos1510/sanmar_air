
app.controller('patientController', function ($scope, $timeout, pacienteService){
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

    $scope.buscarPersonaDocumento = function () {
        if ($("#idtipodocumentocmb").val() != ""){
            if ($("#numerodocumentotxt").val() != ""){
                pacienteService.buscarPersonaDocumento({idtipo_documento: $("#idtipodocumentocmb").val(), 'numero_documento': $("#numerodocumentotxt").val()}).success(function (data) {
                    $scope.registro.numero_documento = data.data.numero_documento;
                    $scope.registro.apellido_paterno = data.data.apellido_paterno;
                    $scope.registro.apellido_materno = data.data.apellido_materno;
                    $scope.registro.nombres = data.data.nombres;
                })
            }
        }
    }

    $scope.guardar = function (){
        //
    }

    $scope.prepararEditar = function (item) {
        //
    }

    $scope.eliminarPaciente = function (item) {
        //
    }

    $scope.listar = function () {
        //
    }

    $scope.listar();
});
