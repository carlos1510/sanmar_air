<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Services\FligthServices;

class FligthController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new FligthServices();
    }

    public function getRutasVuelos(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->getRutasVuelos());
    }
}
