var token = $("meta[name='csrf-token']").attr("content");
var header = $("meta[name='csrf-param']").attr("content");
var csrf_header=[];
csrf_header[header]=token;

app.factory('homeService', function($http){
    return {
        iniciar: function ($params) {
            return $http.post("iniciarSesion", $params)
        },
        probar: function ($params) {
            return $http.post("probar", $params)
        },
        calcularSemanas: function ($params) {
            return $http.post("calcularSemanas", $params)
        },
    }
});

app.factory('personaService', function($http){
    return {
        getPersonaByDNI: function ($params) {
            return $http.post("persona/getPersonaByDNI", $params)
        },
        guardarUpdatePersona: function ($params) {
            return $http.post("persona/guardarUpdatePersona", $params)
        },
        getAtencionesHisByDocumento: function ($params) {
            return $http.post("persona/getAtencionesHisByDocumento", $params)
        },
        getPadronNominalByTipoBusqueda: function ($params) {
            return $http.post("persona/getPadronNominalByTipoBusqueda", $params)
        },
    }
});

app.factory('vacunaCovidService', function($http){
    return {
        listarProfesionalVacunaRed: function ($params) {
            return $http.post("vacunacovid/listarProfesionalVacunaRed", $params)
        },
        guardarRecepcionVacuna: function ($params) {
            return $http.post("vacunacovid/guardarRecepcionVacuna", $params)
        },
        listarRecepcionVacuna: function ($params) {
            return $http.post("vacunacovid/listarRecepcionVacuna", $params)
        },
        guardarObservacionVacuna: function ($params) {
            return $http.post("vacunacovid/guardarObservacionVacuna", $params)
        },
        listarObservacionVacuna: function ($params) {
            return $http.post("vacunacovid/listarObservacionVacuna", $params)
        },
        getTipoVacunaByProfesionalFecha: function ($params) {
            return $http.post("vacunacovid/getTipoVacunaByProfesionalFecha", $params)
        },
        guardarEstadoObservacionVacuna: function ($params) {
            return $http.post("vacunacovid/guardarEstadoObservacionVacuna", $params)
        },
        produccionDigitadoresVacuna: function ($params) {
            return $http.post("vacunacovid/produccionDigitadoresVacuna", $params)
        },
        reporteCoberturaVacuna: function ($params) {
            return $http.post("vacunacovid/reporteCoberturaVacuna", $params)
        },
        reporteCoberturaVacunaDistritos: function ($params) {
            return $http.post("vacunacovid/reporteCoberturaVacunaDistritos", $params)
        },
        getPacienteVacunadoByDNI: function ($params) {
            return $http.post("vacunacovid/getPacienteVacunadoByDNI", $params)
        },
        getPacientesVacunaByNombres: function ($params) {
            return $http.post("vacunacovid/getPacientesVacunaByNombres", $params)
        },
        reporteAvancePorEstablecimiento: function ($params) {
            return $http.post("vacunacovid/reporteAvancePorEstablecimiento", $params)
        },
        reporteVacunaEpidemiologia: function ($params) {
            return $http.post("vacunacovid/reporteVacunaEpidemiologia", $params)
        },
        getReporteCoberturaVacunaRegular: function ($params) {
            return $http.post("vacunacovid/getReporteCoberturaVacunaRegular", $params)
        },
    }
});

app.factory('profesionalService', function($http){
    return {
        getLista: function ($params) {
            return $http.post("profesional/getLista", $params)
        },
        guardarUpdate: function ($params) {
            return $http.post("profesional/guardarUpdate", $params)
        },
        getPerfilbyID: function ($params) {
            return $http.post("profesional/getPerfilbyID", $params)
        },
        updatePerfil: function ($params) {
            return $http.post("profesional/updatePerfil", $params)
        },
        listarProfesionalByDependencia: function ($params) {
            return $http.post("profesional/listarProfesionalByDependencia", $params)
        },
        guardarTramaA: function ($params) {
            return $http.post("profesional/guardarTramaA", $params)
        },
        guardarTurno: function ($params) {
            return $http.post("profesional/guardarTurno", $params)
        },
        guardarTurnoHora: function ($params) {
            return $http.post("profesional/guardarTurnoHora", $params)
        },
    }
});

app.factory('accesorioService', function($http){
    return {
        procesarAtencionesGestante: function ($params) {
            return $http.post("accesorio/procesarAtencionesGestante", $params)
        },
        limpiarAtencionesGestante: function ($params) {
            return $http.post("accesorio/limpiarAtencionesGestante", $params)
        },
        procesarDataPlanificacionFamiliar: function ($params) {
            return $http.post("accesorio/procesarDataPlanificacionFamiliar", $params)
        },
        procesarDataSaludMental: function ($params) {
            return $http.post("accesorio/procesarDataSaludMental", $params)
        },
        procesarDenominadorS3Apendis: function ($params) {
            return $http.post("accesorio/procesarDenominadorS3Apendis", $params)
        },
        procesarGestantesCnv: function ($params) {
            return $http.post("accesorio/procesarGestantesCnv", $params)
        },
        procesarIndicadorS3: function ($params) {
            return $http.post("accesorio/procesarIndicadorS3", $params)
        },
        procesarDenominadorS1GestanteExamen: function ($params) {
            return $http.post("accesorio/procesarDenominadorS1GestanteExamen", $params)
        },
        procesarIndicadorS1GestanteExamen: function ($params) {
            return $http.post("accesorio/procesarIndicadorS1GestanteExamen", $params)
        },
        procesarAtencionesHisNinioProfilaxis: function ($params) {
            return $http.post("accesorio/procesarAtencionesHisNinioProfilaxis", $params)
        },
        procesarDenominadorNinioProfilaxis: function ($params) {
            return $http.post("accesorio/procesarDenominadorNinioProfilaxis", $params)
        },
        procesarIndicadorNinioProfilaxis: function ($params) {
            return $http.post("accesorio/procesarIndicadorNinioProfilaxis", $params)
        },
        getRedes: function ($params) {
            return $http.post("accesorio/getRedes", $params)
        },
        getMicroRedes: function ($params) {
            return $http.post("accesorio/getMicroRedes", $params)
        },
        getEESS: function ($params) {
            return $http.post("accesorio/getEESS", $params)
        },
        getEtnias: function ($params) {
            return $http.post("accesorio/getEtnias", $params)
        },
        getMicroRedByRed: function ($params) {
            return $http.post("accesorio/getMicroRedByRed", $params)
        },
        getEstablecimientoByMicrored: function ($params) {
            return $http.post("accesorio/getEstablecimientoByMicrored", $params)
        },
        procesar_indicador1_sis: function ($params) {
            return $http.post("accesorio/procesar_indicador1_sis", $params)
        },
        procesar_indicador3_sis: function ($params) {
            return $http.post("accesorio/procesar_indicador3_sis", $params)
        },
        limpiarDataProduccionDigitadores: function ($params) {
            return $http.post("accesorio/limpiarDataProduccionDigitadores", $params)
        },
        procesarDataProduccionDigitador: function ($params) {
            return $http.post("accesorio/procesarDataProduccionDigitador", $params)
        },
        getEESSUbigeo: function ($params) {
            return $http.post("accesorio/getEESSUbigeo", $params)
        },
        getListarProfesion: function ($params) {
            return $http.post("accesorio/getListarProfesion", $params)
        },
        getUltimaFechaActualizacion: function ($params) {
            return $http.post("accesorio/getUltimaFechaActualizacion", $params)
        },
        procesarPadronSaludMentalByTipo: function ($params) {
            return $http.post("accesorio/procesarPadronSaludMentalByTipo", $params)
        },
    }
});

app.factory('reportesService', function($http){
    return {
        tramaB1: function ($params) {
            return $http.post("reporte/tramaB1", $params)
        },
        tramaB2: function ($params) {
            return $http.post("reporte/tramaB2", $params)
        },
        tramaC1: function ($params) {
            return $http.post("reporte/tramaC1", $params)
        },
        tramaC2: function ($params) {
            return $http.post("reporte/tramaC2", $params)
        },
        tramaD1: function ($params) {
            return $http.post("reporte/tramaD1", $params)
        },
        tramaD2: function ($params) {
            return $http.post("reporte/tramaD2", $params)
        },
        tramaG: function ($params) {
            return $http.post("reporte/tramaG", $params)
        },
        tramaA: function ($params) {
            return $http.post("reporte/tramaA", $params)
        },
        reporteVisitaProfam: function ($params) {
            return $http.post("reporte/reporteVisitaProfam", $params)
        },
        reporteEpidemologico: function ($params) {
            return $http.post("reporte/reporteEpidemologico", $params)
        },
        indicadorS3Apendis: function ($params) {
            return $http.post("reporte/indicadorS3Apendis", $params)
        },
        indicadorS3ApendisNominal: function ($params) {
            return $http.post("reporte/indicadorS3ApendisNominal", $params)
        },
        reporteTeleSalud: function ($params) {
            return $http.post("reporte/reporteTeleSalud", $params)
        },
        reporte40: function ($params) {
            return $http.post("reporte/reporte40", $params)
        },
        reporteProduccionDigitador: function ($params) {
            return $http.post("reporte/reporteProduccionDigitador", $params)
        },
        reporteProduccionProfesionalVacunaByTipo: function ($params) {
            return $http.post("reporte/reporteProduccionProfesionalVacunaByTipo", $params)
        },
        reporteSaludMentalTeleSalud: function ($params) {
            return $http.post("reporte/reporteSaludMentalTeleSalud", $params)
        },
        reporteProduccionProfesionalByMes: function ($params) {
            return $http.post("reporte/reporteProduccionProfesionalByMes", $params)
        },
    }
});

app.factory('epidemiologiaService', function($http){
    return {
        listarPacientesDengue: function ($params) {
            return $http.post("epidemiologia/listarPacientesDengue", $params)
        },
        guardarPacienteDengueCoordenadas: function ($params) {
            return $http.post("epidemiologia/guardarPacienteDengueCoordenadas", $params)
        },
        getPacientesUbigeoDengue: function ($params) {
            return $http.post("epidemiologia/getPacientesUbigeoDengue", $params)
        },
    }
});



