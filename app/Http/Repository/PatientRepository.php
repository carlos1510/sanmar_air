<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

date_default_timezone_set('America/Lima');

class PatientRepository
{

    public function registrarPaciente($params){
        try {
            if (isset($params->idpaciente)){
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

    public function eliminarPaciente($params){
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

    public function listarPaciente($params){
        try {
            $sql = "";
            return DB::select($sql);
        }catch (Exception $ex){
            //
        }
    }
}
