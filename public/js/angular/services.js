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
        buscarPersonaDocumento: function ($params) {
            return $http.post("paciente/buscarPersonaDocumento", $params)
        },
        registrarPaciente: function ($params) {
            return $http.post("paciente/registrarPaciente", $params)
        },
        eliminarPaciente: function ($params) {
            return $http.post("paciente/eliminarPaciente", $params)
        },
        listarPaciente: function ($params) {
            return $http.post("paciente/listarPaciente", $params)
        },
    }
});

app.factory('vuelosService', function($http){
    return {
        getRutasVuelos: function ($params) {
            return $http.post("vuelos/getRutasVuelos", $params)
        },
        guardarPasajePaciente: function ($params) {
            return $http.post("vuelos/guardarPasajePaciente", $params)
        },
        listarPasajesPaciente: function ($params) {
            return $http.post("vuelos/listarPasajesPaciente", $params)
        },
        listarPasajesReservadosEmpresa: function ($params) {
            return $http.post("vuelos/listarPasajesReservadosEmpresa", $params)
        },
        guardarConfirmarReservaPasaje: function ($params) {
            return $http.post("vuelos/guardarConfirmarReservaPasaje", $params)
        },
        obtenerListaAcompanantes: function ($params) {
            return $http.post("vuelos/obtenerListaAcompanantes", $params)
        },
        listarPasajesReservados: function ($params) {
            return $http.post("vuelos/listarPasajesReservados", $params)
        },
        eliminarPasaje: function ($params) {
            return $http.post("vuelos/eliminarPasaje", $params)
        },
        listarProformas: function ($params) {
            return $http.post("vuelos/listarProformas", $params)
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
        listarUsuarios: function ($params) {
            return $http.post("usuario/listarUsuarios", $params)
        },
        registrarUsuario: function ($params) {
            return $http.post("usuario/registrarUsuario", $params)
        },
        eliminarUsuario: function ($params) {
            return $http.post("usuario/eliminarUsuario", $params)
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



