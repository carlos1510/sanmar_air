<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

use GuzzleHttp\Client;

date_default_timezone_set('America/Lima');

class PatientRepository
{
    public function buscarPersonaDocumento($params){
        try{
            $data['code'] = 200;
            $data['confirm'] = true;
            $data['data'] = array();
            //busqueda de pacientes
            $sql = "SELECT p.id AS idpersona, p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, p.telefono,
                 DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento
                FROM persona p WHERE p.numero_documento='$params->numero_documento' LIMIT 1 ";
            $result = DB::selectOne($sql);

            if(!is_null($result)){
                $data['data'] = (object)$result;
            }else{
                if($params->idtipo_documento == 1 ){
                    $token = 'apis-token-866.a7kD7Q9DNmGj1NG1uYFqp1PxnGB8zpjd';

                    $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
                    $parameters = [
                        'http_errors' => false,
                        'connect_timeout' => 5,
                        'headers' => [
                            'Authorization' => 'Bearer '.$token,
                            'Referer' => 'https://apis.net.pe/api-consulta-dni',
                            'User-Agent' => 'laravel/guzzle',
                            'Accept' => 'application/json',
                        ],
                        'query' => ['numero' => $params->numero_documento]
                    ];
                    $res = $client->request('GET', '/v1/dni', $parameters);
                    $resultado = json_decode($res->getBody()->getContents(), true);
                    $dato = array('numero_documento' => isset($resultado['numeroDocumento'])?$resultado['numeroDocumento']:$params->numero_documento,'apellido_paterno' => isset($resultado['apellidoPaterno'])?$resultado['apellidoPaterno']:null,'apellido_materno' => isset($resultado['apellidoMaterno'])?$resultado['apellidoMaterno']:null,'nombres' => isset($resultado['nombres'])?$resultado['nombres']:null,'nombre' => isset($resultado['nombre'])?$resultado['nombre']:null);
                    $data['data'] = (object)$dato;
                    /*if($resultado['apellidoPaterno'] == ""){
                        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.MTcwMw.JbaYXbRprI5dwWDOFK8vXV1DtBK3v1jZDJSAJq5p6xs';
                        $dni = $params->numero_documento;
                        $json = file_get_contents('https://quertium.com/api/v1/reniec/dni/'.$dni.'?token='.$token);

                        $person = json_decode($json, true);
                        $nombres = $person['primerNombre']." ".$person['segundoNombre'];
                        $dato = array('numero_documento' => $dni, 'apellido_paterno' => $person['apellidoPaterno'], 'apellido_materno' => $person['apellidoMaterno'], 'nombres' => rtrim($nombres), 'nombre' => $person['apellidoPaterno']." ".$person['apellidoMaterno']." ".rtrim($nombres));
                        $data['data'] = (object)$dato;
                    }*/
                }
            }
            return $data;
        }catch (Exception $ex){
            $data['code'] = 409;
            $data['confirm'] = false;
            $data['data'] = array();
            return $data;
        }
    }

    public function registrarPaciente($params){
        try {
            if (isset($params->idpaciente)){
                //editar
                $sql_per = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                DB::update($sql_per, array(
                    'idtipo_documento' => isset($params->idtipo_documento)?$params->idtipo_documento:null,
                    'numero_documento' => isset($params->numero_documento)?$params->numero_documento:null,
                    'apellido_paterno' => isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                    'apellido_materno' => isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                    'nombres' => isset($params->nombres)?strtoupper($params->nombres):null,
                    'sexo' => isset($params->sexo)?$params->sexo:null,
                    'telefono' => isset($params->telefono)?$params->telefono:null,
                    'fecha_nacimiento' => isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                    'correo' => isset($params->correo)?$params->correo:null,
                    'direccion' => isset($params->direccion)?$params->direccion:null,
                    'id' => $params->idpersona
                ));

                $sql = "UPDATE paciente SET idpersona=:idpersona, historia_clinica=:historia_clinica, idcondicion_asegurado=:idcondicion_asegurado, fecha_vigencia=:fecha_vigencia, fecha_modificacion=:fecha_modificacion WHERE id=:id;";
                DB::update($sql, array(
                    'idpersona' => $params->idpaciente,
                    'historia_clinica' => isset($params->historia_clinica)?$params->historia_clinica:null,
                    'idcondicion_asegurado' => isset($params->idcondicion_asegurado)?$params->idcondicion_asegurado:null,
                    'fecha_vigencia' => isset($params->fecha_vigencia)?($params->fecha_vigencia!=""?Util::convertirStringFecha($params->fecha_vigencia, false):null):null,
                    'fecha_modificacion' => date('Y-m-d H:i:s'),
                    'id' => $params->idpaciente
                ));
            }else{
                //registrar
                if (isset($params->idpersona)){
                    $sql_per = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                    DB::update($sql_per, array(
                        'idtipo_documento' => isset($params->idtipo_documento)?$params->idtipo_documento:null,
                        'numero_documento' => isset($params->numero_documento)?$params->numero_documento:null,
                        'apellido_paterno' => isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                        'apellido_materno' => isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                        'nombres' => isset($params->nombres)?strtoupper($params->nombres):null,
                        'sexo' => isset($params->sexo)?$params->sexo:null,
                        'telefono' => isset($params->telefono)?$params->telefono:null,
                        'fecha_nacimiento' => isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                        'correo' => isset($params->correo)?$params->correo:null,
                        'direccion' => isset($params->direccion)?$params->direccion:null,
                        'id' => $params->idpersona
                        ));
                }else{
                    $sql_per = "INSERT INTO persona (idtipo_documento, numero_documento, apellido_paterno, apellido_materno, nombres, sexo, telefono, fecha_nacimiento, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    DB::insert($sql_per, [
                        isset($params->idtipo_documento)?$params->idtipo_documento:null,
                        isset($params->numero_documento)?$params->numero_documento:null,
                        isset($params->apellido_paterno)?strtoupper($params->apellido_paterno):null,
                        isset($params->apellido_materno)?strtoupper($params->apellido_materno):null,
                        isset($params->nombres)?strtoupper($params->nombres):null,
                        isset($params->sexo)?$params->sexo:null,
                        isset($params->telefono)?$params->telefono:null,
                        isset($params->fecha_nacimiento)?($params->fecha_nacimiento!=""?Util::convertirStringFecha($params->fecha_nacimiento, false):null):null,
                        isset($params->correo)?$params->correo:null,
                        isset($params->direccion)?$params->direccion:null,
                    ]);
                    $idper = DB::selectOne('SELECT max(id) as id FROM persona');
                }
                $idpersona = isset($params->idpersona)?$params->idpersona:$idper->id;
                $sql = "INSERT INTO paciente (idpersona, historia_clinica, idcondicion_asegurado, fecha_vigencia, fecha_registro, fecha_modificacion, idusuario, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                DB::insert($sql, [
                    $idpersona,
                    isset($params->historia_clinica)?$params->historia_clinica:null,
                    isset($params->idcondicion_asegurado)?$params->idcondicion_asegurado:null,
                    isset($params->fecha_vigencia)?($params->fecha_vigencia!=""?Util::convertirStringFecha($params->fecha_vigencia, false):null):null,
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                    null,
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

    public function eliminarPaciente($params){
        try {
            $sql = "UPDATE paciente SET estado=0 WHERE id=:id;";
            DB::update($sql, array('id' => $params->idpaciente));
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function listarPaciente($params){
        try {
            $sql = "SELECT pac.id AS idpaciente, pac.idpersona, pac.historia_clinica, per.idtipo_documento, per.numero_documento,per.direccion, pac.idcondicion_asegurado, DATE_FORMAT(pac.fecha_vigencia, '%d/%m/%Y') AS fecha_vigencia,
                per.apellido_paterno, per.apellido_materno, per.nombres, per.sexo, DATE_FORMAT(per.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, per.telefono,
                IF(per.idtipo_documento=1,'DNI', IF(per.idtipo_documento=2,'CARNET DE EXTRANJERIA', 'PASAPORTE')) AS nom_tipo_documento, IF(pac.idcondicion_asegurado=1,'SEGURO REGULAR D.LEG 1057 (CAS)','') as nom_condicion_asegurado
                FROM paciente pac INNER JOIN persona per ON pac.idpersona=per.id
                WHERE pac.estado=1";
            return DB::select($sql);
        }catch (Exception $ex){
            //
        }
    }
}
