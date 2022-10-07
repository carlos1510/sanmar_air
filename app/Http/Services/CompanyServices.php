<?php

namespace App\Http\Services;

use App\Http\Repository\CompanyRepository;

class CompanyServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CompanyRepository();
    }

    public function registrarEmpresa($params){
        $params = (object)$params;
        return $this->repository->registrarEmpresa($params);
    }

    public function eliminarEmpresa($params){
        $params = (object)$params;
        return $this->repository->eliminarEmpresa($params);
    }

    public function listarEmpresa($params){
        $params = (object)$params;
        return $this->repository->listarEmpresa($params);
    }
}
