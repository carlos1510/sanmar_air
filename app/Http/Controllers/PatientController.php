<?php

namespace App\Http\Controllers;

use App\Http\Services\PatientServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

date_default_timezone_set('America/Lima');

class PatientController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new PatientServices();
    }

    public function registrarPaciente(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->registrarPaciente($params));
    }

    public function eliminarPaciente(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarPaciente($params));
    }

    public function listarPaciente(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarPaciente($params));
    }
}
