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

    $scope.generarDeclaracionJurada = function () {
        var date = new Date();
        var pdf = new jsPDF("p","mm","a4");
        pdf.setFontSize(11);
        pdf.text( 'ANEXO N° 12', 90, 20 );
        pdf.text( 'DECLARACION JURADA PARA PERSONAS JURIDICAS', 50, 25 );
        pdf.text( 'Pucallpa, '+ ('0'+date.getDate()).toString().substr(-2) +' de ' + obtenerNombreMes((date.getMonth() + 1 )) + ' del ' + date.getFullYear(), 10, 35 );
        pdf.text( 'Señores', 10, 45 );
        pdf.text( 'ESSALUD', 10, 50 );
        pdf.text( 'Presente.-', 10, 55 );
        pdf.text( 'Mediante la presente, Yo SANDRA MARLENY ANTICORA LARA, identificado con DNI N° 43229235,', 10, 70 );
        pdf.text( 'en mi condicion de Representante Legal de FENIX EMERGENCY GROUP E.I.R.L con', 10, 75 );
        pdf.text( 'RUC N° 20606397322, DECLARO BAJO JURAMENTO que la siguiente informacion se sujeta a la verdad :', 10, 80 );
        pdf.text( '(INDICAR "SI" O "NO", SEGÚN CORRESPONDA)', 10, 90 );

        pdf.rect(10, 94, 15, 8, 'S'); pdf.text('SI', 17, 99, 'center'); pdf.addFont()
        pdf.rect(25, 94, 15, 8, 'S'); pdf.text('NO', 32, 99, 'center');
        pdf.rect(40, 94, 155, 8, 'S'); pdf.text('DECLARACION JURADO', 120, 99, 'center');

        pdf.rect(10, 102, 15, 8, 'S'); pdf.text('X', 17, 107, 'center');
        pdf.rect(25, 102, 15, 8, 'S'); pdf.text('', 32, 107, 'center');
        pdf.rect(40, 102, 155, 8, 'S'); pdf.text('Me encuentro inscrito en el Registro Nacional de Proveedores (RNP)', 100, 107, 'center');

        pdf.rect(10, 110, 15, 14, 'S'); pdf.text('', 17, 114, 'center');
        pdf.rect(25, 110, 15, 14, 'S'); pdf.text('X', 32, 118, 'center');
        pdf.rect(40, 110, 155, 14, 'S');
        pdf.text('Estoy inhabilitado para contratar con el estado, ni temporal, ni permanente,', 106, 114, 'center');
        pdf.text('conforme lo establece el articulo 11 texto Unico Ordenado de la Ley N° 30225 de,', 112, 118, 'center');
        pdf.text('Contratacion del estado, aprobado por Decreto Supremo N° 082-2019-EF', 105, 122, 'center');

        pdf.rect(10, 124, 15, 20, 'S'); pdf.text('X', 17, 134, 'center');
        pdf.rect(25, 124, 15, 20, 'S'); pdf.text('', 32, 130, 'center');
        pdf.rect(40, 124, 155, 20, 'S');
        pdf.text('Estoy de acuerdo y me comprometo a respetar los lineamientos', 96, 129, 'center');
        pdf.text('establecidos en el articulo 138° del Reglamento de la ley N° 30225, Ley de', 105, 133, 'center');
        pdf.text('Contrataciones del Estado, aprobado por Derecho Supremo N° 344-2018-EF,', 107, 137, 'center');
        pdf.text('respeto a las clausulas anticorrupcion.', 74, 141, 'center');

        pdf.rect(10, 144, 15, 45, 'S'); pdf.text('X', 17, 166, 'center');
        pdf.rect(25, 144, 15, 45, 'S'); pdf.text('', 32, 166, 'center');
        pdf.rect(40, 144, 155, 45, 'S');
        pdf.text('Trataremos la informacion recibida como estrictamente cofidencial y', 100, 150, 'center');
        pdf.text('privada y tomaremos todas las medidas del caso para preservar esta', 101, 154, 'center');
        pdf.text('confidencialidad. Usaremos la informacion recibida  con el unico y', 98, 158, 'center');
        pdf.text('exclusivo proposito de realizar la prestacion, por lo que nos obligaron a', 102.5, 162, 'center');
        pdf.text('no divulgar la informacion recibida a terceros, salvo autorizacion expresa,', 105, 166, 'center');
        pdf.text('previa del EsSalud. En caso nos veamos obligados legalmente o', 97.5, 170, 'center');
        pdf.text('judicialmente a divulgar la informacion recibida, pondremos en', 95.5, 174, 'center');
        pdf.text('conocimiento de EsSalud este hecho antes de la divulgacion de la', 98.5, 178, 'center');
        pdf.text('informacion , a fin de que Essalud pueda tomar las acciones pertinentes', 103.8, 182, 'center');
        pdf.text('para proteger la confidencialidad de la informacion de ser el caso.', 98.5, 186, 'center');

        pdf.autoPrint({variant: 'non-conform'});

        pdf.save('declaracion_jurada.pdf');
    }

    $scope.inicio();
    $timeout(function () {
        $scope.listar();
    }, 200);

});
