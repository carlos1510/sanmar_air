<?php

namespace App\Http\Controllers;

use App\Http\Exports\PasajesReportExport;
use App\Http\Exports\ReservedReportExport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Services\FligthServices;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FligthController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new FligthServices();
    }

    public function getRutasVuelos(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->getRutasVuelos());
    }

    public function guardarPasajePaciente(Request $request){
        $content = $request->get('registro');
        $params = json_decode($content);

        $result = $this->service->guardarPasajePaciente($params);
        $resultado = (object)$result;

        if (count($request->files) > 0){
            for ($i = 1; $i <= count($request->files); $i++){
                $archivo = $request->files->get('archivo_'.$i);
                $nombre_original = $archivo->getClientOriginalName();
                $extension = $archivo->getClientOriginalExtension();
                $nombre_archivo = "paciente_id_".$resultado->idpasaje_paciente."_nro_".$i.".".$extension;
                $datos = array('idpasaje_paciente' => $resultado->idpasaje_paciente, 'nombre_archivo' => $nombre_archivo, 'extension_archivo' => $extension, 'numero_archivo' =>$i);
                $res = $this->service->guardarArchivosPaciente($datos);
                if ($res == true){
                    Storage::disk('documentos_paciente')->put($nombre_archivo,  \File::get($archivo) );
                }
            }
        }

        return new JsonResponse($result);
    }

    public function listarPasajesPaciente(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarPasajesPaciente($params));
    }

    public function listarPasajesReservadosEmpresa(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarPasajesReservadosEmpresa($params));
    }

    public function guardarConfirmarReservaPasaje(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->guardarConfirmarReservaPasaje($params));
    }

    public function obtenerListaAcompanantes(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->obtenerListaAcompanantes($params));
    }

    public function obtenerListaPersonalSalud(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->obtenerListaPersonalSalud($params));
    }

    public function listarPasajesReservados(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarPasajesReservados($params));
    }

    public function eliminarPasaje(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarPasaje($params));
    }

    public function listarProformas(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarProformas($params));
    }

    public function obtenerDocumentosById(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->obtenerDocumentosById($params));
    }

    public function generarCodigoTicket(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->generarCodigoTicket($params));
    }

    public function guardarOficioProforma(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->guardarOficioProforma($params));
    }

    public function guardarActaConformidadProforma(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->guardarActaConformidadProforma($params));
    }

    public function guardarMontoAsignado(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->guardarMontoAsignado($params));
    }

    public function obtenerDatosGeneradosOficio(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->obtenerDatosGeneradosOficio($params));
    }

    public function listarOficios(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarOficios($params));
    }

    public function listarActaConformidad(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarActaConformidad($params));
    }

    public function listarOficiosDetalle(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarOficiosDetalle($params));
    }

    public function listarActaConformidadDetalle(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarActaConformidadDetalle($params));
    }

    public function exportarReservasPasajesEmpresa(Request $request){
        return Excel::download(new ReservedReportExport($request->get('estado'), $request->get('fecha_inicio'), $request->get('fecha_final'), $request->get('numero_documento')), 'ReporteReservaPasaje_'.date('YmdHis').'.xlsx');
    }

    public function exportarPasajesReservadosReporte(Request $request){
        return Excel::download(new PasajesReportExport($request->get('estado'), $request->get('fecha_inicio'), $request->get('fecha_final'), $request->get('numero_documento'), $request->get('tipo_servicio'), $request->get('idruta_viaje_precio')), 'ReporteReservaPasaje_'.date('YmdHis').'.xlsx');
    }
}
