<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Services\FligthServices;

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
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->guardarPasajePaciente($params));
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
}
