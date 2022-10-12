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

app.factory('pacienteService', function($http){
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

app.factory('empresaService', function($http){
    return {
        registrarEmpresa: function ($params) {
            return $http.post("empresa/registrarEmpresa", $params)
        },
        listarEmpresa: function ($params) {
            return $http.post("empresa/listarEmpresa", $params)
        },
        eliminarEmpresa: function ($params) {
            return $http.post("empresa/eliminarEmpresa", $params)
        },

    }
});

app.factory('usuarioService', function($http){
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
    }
});

app.factory('seguimientoService', function($http){
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



