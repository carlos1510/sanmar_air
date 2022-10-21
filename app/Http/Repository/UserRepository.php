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
                $sql_per = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                DB::update($sql_per, array(
                    'idtipo_documento' => isset($params->idtipo_documento)?($params->idtipo_documento!=""?$params->idtipo_documento:null):null,
                    'numero_documento' => isset($params->numero_documento)?$params->numero_documento:null,
                    'apellido_paterno' => isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                    'apellido_materno' => isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                    'nombres' => isset($params->nombres)?strtoupper($params->nombres):null,
                    'sexo' => isset($params->sexo)?($params->sexo!=""?$params->sexo:null):null,
                    'telefono' => isset($params->telefono)?$params->telefono:null,
                    'fecha_nacimiento' => isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                    'correo' => isset($params->correo)?$params->correo:null,
                    'direccion' => isset($params->direccion)?$params->direccion:null,
                    'id' => $params->idpersona
                ));
                $sql = "UPDATE usuario SET idpersona=:idpersona, usuario=:usuario, password=:password, idnivel=:idnivel, acceso=:acceso, idempresa=:idempresa, fecha_actualizacion=:fecha_actualizacion WHERE id=:id;";
                DB::update($sql, array(
                    'idpersona' => $params->idpersona,
                    'usuario' => isset($params->usuario)?$params->usuario:null,
                    'password' => isset($params->password)?$params->password:null,
                    'idnivel' => isset($params->idnivel)?($params->idnivel!=""?$params->idnivel:null):null,
                    'acceso' => isset($params->acceso)?($params->acceso!=""?$params->acceso:null):null,
                    'idempresa' => isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null,
                    'fecha_actualizacion' => date('Y-m-d H:i:s'),
                    'id' => $params->idusuario
                ));
            }else{
                //registrar
                if (isset($params->idpersona)){
                    $sql_per = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                    DB::update($sql_per, array(
                        'idtipo_documento' => isset($params->idtipo_documento)?($params->idtipo_documento!=""?$params->idtipo_documento:null):null,
                        'numero_documento' => isset($params->numero_documento)?$params->numero_documento:null,
                        'apellido_paterno' => isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                        'apellido_materno' => isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                        'nombres' => isset($params->nombres)?strtoupper($params->nombres):null,
                        'sexo' => isset($params->sexo)?($params->sexo!=""?$params->sexo:null):null,
                        'telefono' => isset($params->telefono)?$params->telefono:null,
                        'fecha_nacimiento' => isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                        'correo' => isset($params->correo)?$params->correo:null,
                        'direccion' => isset($params->direccion)?$params->direccion:null,
                        'id' => $params->idpersona
                    ));
                }else{
                    $sql_per = "INSERT INTO persona (idtipo_documento, numero_documento, apellido_paterno, apellido_materno, nombres, sexo, telefono, fecha_nacimiento, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    DB::insert($sql_per, [
                        isset($params->idtipo_documento)?($params->idtipo_documento!=""?$params->idtipo_documento:null):null,
                        isset($params->numero_documento)?$params->numero_documento:null,
                        isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                        isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                        isset($params->nombres)?strtoupper($params->nombres):null,
                        isset($params->sexo)?($params->sexo!=""?$params->sexo:null):null,
                        isset($params->telefono)?$params->telefono:null,
                        isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                        isset($params->correo)?$params->correo:null,
                        isset($params->direccion)?$params->direccion:null,
                    ]);
                    $idper = DB::selectOne('SELECT max(id) as id FROM persona');
                }

                $sql = "INSERT INTO usuario (idpersona, usuario, password, idnivel, acceso, idempresa, fecha_creacion, fecha_actualizacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
                DB::insert($sql, [
                    isset($params->idpersona)?$params->idpersona:$idper->id,
                    isset($params->usuario)?$params->usuario:null,
                    isset($params->password)?$params->password:null,
                    isset($params->idnivel)?($params->idnivel!=""?$params->idnivel:null):null,
                    isset($params->acceso)?($params->acceso!=""?$params->acceso:null):null,
                    isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null,
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
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
        $sql = "SELECT u.id as idusuario, u.idpersona, u.usuario, u.`password`, u.idnivel, u.acceso, IF(u.acceso=1,'SI','NO') AS nom_acceso, u.idempresa, u.fecha_creacion, u.fecha_actualizacion,
                u.estado, per.idtipo_documento, per.numero_documento, per.apellido_paterno, per.apellido_materno, per.nombres, per.sexo,
                per.telefono, DATE_FORMAT(per.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, per.correo, per.direccion, e.razon_social, n.nivel
                FROM usuario u INNER JOIN persona per ON u.idpersona=per.id
                LEFT JOIN empresa e ON u.idempresa=e.id
                LEFT JOIN nivel n ON u.idnivel=n.id
                WHERE u.estado=1";
        return DB::select($sql);
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
