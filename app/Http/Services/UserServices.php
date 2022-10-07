<?php

namespace App\Http\Services;

use App\Http\Repository\UserRepository;

class UserServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function registrarUsuario($params){
        $params = (object)$params;
        return $this->repository->registrarUsuario($params);
    }

    public function eliminarUsuario($params){
        $params = (object)$params;
        return $this->repository->eliminarUsuario($params);
    }

    public function listarUsuarios($params){
        $params = (object)$params;
        return $this->repository->listarUsuarios($params);
    }

    public function quitarAccesoUsuario($params){
        $params = (object)$params;
        return $this->repository->quitarAccesoUsuario($params);
    }

    public function obtenerUsuarioSesion($params){
        $params = (object)$params;
        return $this->repository->obtenerUsuarioSesion($params);
    }
}
