<?php

namespace App\Http\Controllers;

use App\Http\Services\TracingServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

date_default_timezone_set('America/Lima');

class TracingController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new TracingServices();
    }

    public function registrarSeguimiento(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->registrarSeguimiento($params));
    }

    public function eliminarSeguimiento(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarSeguimiento($params));
    }

    public function listarSeguimiento(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarSeguimiento($params));
    }

    public function anularSeguimiento(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->anularSeguimiento($params));
    }
}
