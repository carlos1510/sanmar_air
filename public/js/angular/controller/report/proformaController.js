/**
 * Created by carlo on 1/09/2018.
 */

app.controller('proformaController', function ($scope, $timeout, empresaService, vuelosService){
    $scope.dtInstance = {};
    $scope.elementos = {lista:[]};

    $scope.estado_registro = 0;
    $scope.registro = {};

    $scope.filtro = {};
    $scope.lista = [];
    $scope.total = 0.00;
    $scope.rutas = [];

    vuelosService.getRutasVuelos({}).success(function (data) {
        $scope.rutas = data;
    })

    $scope.inicio = function () {
        var date = new Date();
        var primerDia = new Date(date.getFullYear(), date.getMonth() , 1);
        var ultimoDia = new Date(date.getFullYear(), (date.getMonth() + 1), 0);

        $scope.filtro.fecha_inicio = ('0'+primerDia.getDate()).toString().substr(-2)+'/'+('0'+(primerDia.getMonth()+1)).toString().substr(-2)+'/'+primerDia.getFullYear();
        $scope.filtro.fecha_final = ('0'+ultimoDia.getDate()).toString().substr(-2)+'/'+('0'+(ultimoDia.getMonth()+1)).toString().substr(-2)+'/'+ultimoDia.getFullYear();

    }

    $scope.salir = function () {
        $scope.estado_registro = 0;
        $scope.registro = {};
    }

    $scope.listar = function () {
        $scope.total = 0.00;
        vuelosService.listarProformas($scope.filtro).success(function (data) {
            $scope.lista = data;
            var total = 0;
            for (var i = 0; i < $scope.lista.length; i++){
                total += parseFloat($scope.lista[i].precio_unitario);
            }
            $scope.total = total;
        });
    }

    $scope.inicio();
    $timeout(function () {
        $scope.listar();
    }, 200);

});
