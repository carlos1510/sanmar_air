<?php

namespace App\Http\Services;

use App\Http\Repository\ReportTracingRepository;

class ReportTracingServices
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ReportTracingRepository();
    }

    public function reporteSeguimiento($params){
        $params = (object)$params;
        return $this->repository->reporteSeguimiento($params);
    }
}
