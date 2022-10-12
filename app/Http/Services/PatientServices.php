<?php

namespace App\Http\Services;

use App\Http\Repository\PatientRepository;

class PatientServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PatientRepository();
    }

    public function buscarPersonaDocumento($params){
        $params = (object)$params;
        return $this->repository->buscarPersonaDocumento($params);
    }

    public function registrarPaciente($params){
        $params = (object)$params;
        return $this->repository->registrarPaciente($params);
    }

    public function eliminarPaciente($params){
        $params = (object)$params;
        return $this->repository->eliminarPaciente($params);
    }

    public function listarPaciente($params){
        $params = (object)$params;
        return $this->repository->listarPaciente($params);
    }
}
