<?php

namespace App\Http\Controllers;

use App\Http\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

date_default_timezone_set('America/Lima');

class UserController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserServices();
    }

    public function registrarUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->registrarUsuario($params));
    }

    public function eliminarUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarUsuario($params));
    }

    public function listarUsuarios(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarUsuarios($params));
    }

    public function quitarAccesoUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->quitarAccesoUsuario($params));
    }

    public function obtenerUsuarioSesion(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->obtenerUsuarioSesion($params));
    }
}
