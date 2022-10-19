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
}
