<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

date_default_timezone_set('America/Lima');

class ReportTracingRepository
{
    public function reporteSeguimiento($params){
        try {
            $sql = "";
            return DB::select($sql);
        }catch (Exception $ex){
            //
        }
    }
}
