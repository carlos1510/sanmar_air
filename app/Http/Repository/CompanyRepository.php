<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

date_default_timezone_set('America/Lima');

class CompanyRepository
{

    public function registrarEmpresa($params){
        try {
            if (isset($params->idempresa)){
                //editar
                $sql = "";
                DB::update($sql, array());
            }else{
                //registrar
                $sql = "";
                DB::insert($sql, []);
            }
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            //
        }
    }

    public function eliminarEmpresa($params){
        try {
            $sql = "";
            DB::update($sql, array());
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function listarEmpresa($params){
        try {
            $sql = "";
            return DB::select($sql);
        }catch (Exception $ex){
            //
        }
    }
}
