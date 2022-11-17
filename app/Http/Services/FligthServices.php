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

    public function guardarArchivosPaciente($params){
        $params = (object)$params;
        return $this->repository->guardarArchivosPaciente($params);
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

    public function obtenerListaPersonalSalud($params){
        $params = (object)$params;
        return $this->repository->obtenerListaPersonalSalud($params);
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

    public function obtenerDocumentosById($params){
        $params = (object)$params;
        return $this->repository->obtenerDocumentosById($params);
    }

    public function generarCodigoTicket($params){
        $params = (object)$params;
        return $this->repository->generarCodigoTicket($params);
    }

    public function guardarOficioProforma($params){
        $params = (object)$params;
        return $this->repository->guardarOficioProforma($params);
    }

    public function guardarActaConformidadProforma($params){
        $params = (object)$params;
        return $this->repository->guardarActaConformidadProforma($params);
    }

    public function guardarMontoAsignado($params){
        $params = (object)$params;
        return $this->repository->guardarMontoAsignado($params);
    }

    public function obtenerDatosGeneradosOficio($params){
        $params = (object)$params;
        return $this->repository->obtenerDatosGeneradosOficio($params);
    }

    public function listarOficios($params){
        $params = (object)$params;
        return $this->repository->listarOficios($params);
    }

    public function listarActaConformidad($params){
        $params = (object)$params;
        return $this->repository->listarActaConformidad($params);
    }

    public function listarOficiosDetalle($params){
        $params = (object)$params;
        return $this->repository->listarOficiosDetalle($params);
    }
}
