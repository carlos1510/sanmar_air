/**
 * Created by carlo on 6/06/2017.
 */

'use strict';
var app=angular.module('app', []);

/*app.directive('typeahead', ['$compile', '$timeout', function($compile, $timeout)   {
    return {
        restrict: 'A',
        transclude: true,
        scope: {
            ngModel: '=',
            typeahead: '=',
            typeaheadCallback: "="
        },
        link: function(scope, elem, attrs) {
            var template = '<div class="dropdown"><ul class="dropdown-menu" style="display:block;" ng-hide="!ngModel.length || !filitered.length || selected"><li ng-repeat="item in filitered = (typeahead | filter:{name:ngModel} | limitTo:5) track by $index" ng-click="click(item)" style="cursor:pointer" ng-class="{active:$index==active}" ng-mouseenter="mouseenter($index)"><a>{{item.name}}</a></li></ul></div>'

            elem.bind('blur', function() {
                $timeout(function() {
                    scope.selected = true
                }, 100)
            })

            elem.bind("keydown", function($event) {
                if($event.keyCode == 38 && scope.active > 0) { // arrow up
                    scope.active--
                    scope.$digest()
                } else if($event.keyCode == 40 && scope.active < scope.filitered.length - 1) { // arrow down
                    scope.active++
                    scope.$digest()
                } else if($event.keyCode == 13) { // enter
                    scope.$apply(function() {
                        scope.click(scope.filitered[scope.active])
                    })
                }
            })

            scope.click = function(item) {
                scope.ngModel = item.name
                scope.selected = item
                if(scope.typeaheadCallback) {
                    scope.typeaheadCallback(item)
                }
                elem[0].blur()
            }

            scope.mouseenter = function($index) {
                scope.active = $index
            }

            scope.$watch('ngModel', function(input) {

                if(scope.selected && scope.selected.name == input) {
                    return
                }

                scope.active = 0
                scope.selected = false

                // if we have an exact match and there is only one item in the list, automatically select it
                if(input && scope.filitered.length == 1 && scope.filitered[0].name.toLowerCase() == input.toLowerCase()) {
                    scope.click(scope.filitered[0])
                }
            })

            elem.after($compile(template)(scope))
        }
    }

}]);*/

app.directive('uploaderModel', ["$parse", function($parse){
    return {
        restrict: 'A',
        link: function(scope, iElement, iAttrs){
            iElement.on("change", function(e){
                $parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
            })
        }
    }
}]);

app.service('upload', ["$http", "$q", function($http, $q){
    this.uploadFile = function(file, name, url){
        var deferred = $q.defer();
        var formData = new FormData();
        formData.append("name", name);
        formData.append("file", file);
        return $http.post(url, formData, {
            headers: {
                "Context-type": undefined
            },
            transformRequest: formData
        })
            .success(function(res){
                deferred.resolve(res);
            })
            .error(function(msg, code){
                deferred.reject(msg);
            })
        return deferred.promise;
    }
}]);

app.filter('startFrom', function()
{
    return function(input, start) {
        var outPut=[];
        if(input) {
            start = +start;
            outPut = input.slice(start);
            return outPut;
        }
        return outPut;
    };
});

app.run(function($rootScope,$sce,$filter,$timeout ) {
    $rootScope.allowHtml=function(text){
        if(text!=null){
            text=text.replace(/\n/g,"<br />");
            return $sce.trustAsHtml(text);
        }
        return null;
    }

   /* $rootScope.datatableLanguageConfig={
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
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": activado para ordenar columna ascendente",
            "sSortDescending": ": activado para ordenar columna descendente"
        }
    };*/



    // filtrado de datos
    $rootScope.page={
        objects:[],
        currentPage:0,
        pageSize:20,
        numberPage:0,
        pages:[]
    };

    $rootScope.basic={};
    $rootScope.filterPager={};

    $rootScope.changePage = function (number)
    {
        $rootScope.page.currentPage = (number-1);
    };

    $rootScope.numberOfPages=function(sizeList){
        if(sizeList>0)
        {
            $rootScope.page.numberPage= Math.ceil(sizeList/$rootScope.page.pageSize);
            for (var i = 0; i < $rootScope.page.numberPage; i++)
            {
                $rootScope.page.pages.push((i+1));
            }
        }
    };

    $rootScope.searchFilter = function (dataList, inputSearch)
    {
        var out = $filter('filter')(dataList, inputSearch);
        $rootScope.page.pages=[];
        $rootScope.numberOfPages(out.length);
        $rootScope.page.objects = out;
        return out;
    };
});
