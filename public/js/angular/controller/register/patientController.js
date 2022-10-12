
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
