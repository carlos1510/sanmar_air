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
            $sql = "SELECT p.id AS idpersona, p.tipo_documento, p.nro_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, p.idetnia, p.idubigeo, p.direccion, p.telefono,
                 DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento
                FROM persona p WHERE p.nro_documento='$params->nro_documento'";
            $result = DB::selectOne($sql);

            if(!is_null($result)){
                $data['data'] = $result;
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
                        'query' => ['numero' => $params->nro_documento]
                    ];
                    $res = $client->request('GET', '/v1/dni', $parameters);
                    $resultado = json_decode($res->getBody()->getContents(), true);
                    $dato[] = array('nro_documento' => $resultado['numeroDocumento'],'apellido_paterno' => $resultado['apellidoPaterno'],'apellido_materno' => $resultado['apellidoMaterno'],'nombres' => $resultado['nombres'],'nombre' => $resultado['nombre']);
                    $data['data'] = $dato;
                    if($resultado['apellidoPaterno'] == ""){
                        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.MTcwMw.JbaYXbRprI5dwWDOFK8vXV1DtBK3v1jZDJSAJq5p6xs';
                        $dni = $params->nro_documento;
                        $json = file_get_contents('https://quertium.com/api/v1/reniec/dni/'.$dni.'?token='.$token);

                        $person = json_decode($json, true);
                        $nombres = $person['primerNombre']." ".$person['segundoNombre'];
                        $dato[] = array('nro_documento' => $dni, 'apellido_paterno' => $person['apellidoPaterno'], 'apellido_materno' => $person['apellidoMaterno'], 'nombres' => rtrim($nombres), 'nombre' => $person['apellidoPaterno']." ".$person['apellidoMaterno']." ".rtrim($nombres));
                        $data['data'] = $dato;
                    }
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
