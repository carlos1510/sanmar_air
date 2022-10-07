<?php

namespace App\Http\Services;

use App\Http\Repository\TracingRepository;

class TracingServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TracingRepository();
    }

    public function registrarSeguimiento($params){
        $params = (object)$params;
        return $this->repository->registrarSeguimiento($params);
    }

    public function eliminarSeguimiento($params){
        $params = (object)$params;
        return $this->repository->eliminarSeguimiento($params);
    }

    public function listarSeguimiento($params){
        $params = (object)$params;
        return $this->repository->listarSeguimiento($params);
    }

    public function anularSeguimiento($params){
        $params = (object)$params;
        return $this->repository->anularSeguimiento($params);
    }

}
