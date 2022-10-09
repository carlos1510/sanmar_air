<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

date_default_timezone_set('America/Lima');
class UserRepository
{

    public function registrarUsuario($params){
        try {
            if (isset($params->idusuario)){
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
            $data['confirm'] = false;
            return $data;
        }
    }

    public function eliminarUsuario($params){
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

    public function listarUsuarios($params){
        try {
            //
        }catch (Exception $ex){
            //
        }
    }

    public function quitarAccesoUsuario($params){
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

    public function obtenerUsuarioSesion($params){
        try {
            $sql = "";
            $resultado = DB::selectOne($sql);
        }catch (Exception $ex){
            //
        }
    }
}
