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
            $sql = "SELECT * FROM usuario WHERE usuario='$params->usuario' AND password='$params->password' AND estado=1 AND acceso=1 LIMIT 1";
            $resultado = DB::selectOne($sql);
            $data['confirm'] = true;
            $data['user'] = $resultado;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return  $data;
        }
    }
}
