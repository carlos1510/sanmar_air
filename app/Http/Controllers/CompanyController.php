<?php

namespace App\Http\Controllers;

use App\Http\Services\CompanyServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

date_default_timezone_set('America/Lima');

class CompanyController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CompanyServices();
    }

    public function registrarEmpresa(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->registrarEmpresa($params));
    }

    public function eliminarEmpresa(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarEmpresa($params));
    }

    public function listarEmpresa(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarEmpresa($params));
    }


}
