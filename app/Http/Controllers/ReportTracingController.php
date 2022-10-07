<?php

namespace App\Http\Controllers;

use App\Http\Services\ReportTracingServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

date_default_timezone_set('America/Lima');

class ReportTracingController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ReportTracingServices();
    }

    public function reporteSeguimiento(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->reporteSeguimiento($params));
    }
}
