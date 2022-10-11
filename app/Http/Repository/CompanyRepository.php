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
                $sql = "UPDATE empresa SET ruc=:ruc, razon_social=:razon_social, telefono=:telefono, direccion=:direccion, correo=:correo WHERE id=:id;";
                DB::update($sql, array(
                    'ruc' => isset($params->ruc)?$params->ruc:null,
                    'razon_social' => isset($params->razon_social)?$params->razon_social:null,
                    'telefono' => isset($params->telefono)?$params->telefono:null,
                    'direccion' => isset($params->direccion)?$params->direccion:null,
                    'correo' => isset($params->correo)?$params->correo:null
                ));
            }else{
                //registrar
                $sql = "INSERT INTO empresa (ruc, razon_social, telefono, direccion, correo, estado) VALUES (?, ?, ?, ?, ?, ?);";
                DB::insert($sql, [
                    isset($params->ruc)?$params->ruc:null,
                    isset($params->razon_social)?$params->razon_social:null,
                    isset($params->telefono)?$params->telefono:null,
                    isset($params->direccion)?$params->direccion:null,
                    isset($params->correo)?$params->correo:null,
                    1
                ]);
            }
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function eliminarEmpresa($params){
        try {
            $sql = "UPDATE empresa SET estado=0 WHERE id=:id";
            DB::update($sql, array('id' => $params->id));
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function listarEmpresa($params){
        try {
            $sql = "SELECT id AS idempresa, ruc, razon_social, telefono, direccion, correo FROM empresa WHERE estado=1";
            return DB::select($sql);
        }catch (Exception $ex){
            //
        }
    }
}
