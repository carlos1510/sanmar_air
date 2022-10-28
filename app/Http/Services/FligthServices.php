<?php

namespace App\Http\Services;

use App\Http\Repository\FligthRepository;

class FligthServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new FligthRepository();
    }

    public function getRutasVuelos(){
        return $this->repository->getRutasVuelos();
    }

    public function guardarPasajePaciente($params){
        $params = (object)$params;
        return $this->repository->guardarPasajePaciente($params);
    }

    public function listarPasajesPaciente($params){
        $params = (object)$params;
        return $this->repository->listarPasajesPaciente($params);
    }

    public function listarPasajesReservadosEmpresa($params){
        $params = (object)$params;
        return $this->repository->listarPasajesReservadosEmpresa($params);
    }

    public function guardarConfirmarReservaPasaje($params){
        $params = (object)$params;
        return $this->repository->guardarConfirmarReservaPasaje($params);
    }

    public function obtenerListaAcompanantes($params){
        $params = (object)$params;
        return $this->repository->obtenerListaAcompanantes($params);
    }

    public function listarPasajesReservados($params){
        $params = (object)$params;
        return $this->repository->listarPasajesReservados($params);
    }

    public function eliminarPasaje($params){
        $params = (object)$params;
        return $this->repository->eliminarPasaje($params);
    }

    public function listarProformas($params){
        $params = (object)$params;
        return $this->repository->listarProformas($params);
    }
}
