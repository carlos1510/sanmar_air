/**
 * Created by carlo on 1/09/2018.
 */

app.controller('homeController', function ($scope, $timeout, accesorioService){
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



});
