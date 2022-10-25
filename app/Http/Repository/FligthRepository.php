<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Util\Util;

date_default_timezone_set('America/Lima');

class FligthRepository
{

    public function getRutasVuelos(){
        $sql = "SELECT id, origen, destino, CONCAT_WS(' - ',origen,destino) AS nom_ruta FROM ruta_viaje_precio WHERE estado=1";
        return DB::select($sql);
    }

    public function guardarPasajePaciente($params){
        try {
            if (isset($params->idpasaje_paciente)){
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

                $sql_pasaje = "UPDATE pasaje_paciente SET idpersona=:idpersona, tipo_servicio=:tipo_servicio, vuelos=:vuelos, idruta_viaje_precio=:idruta_viaje_precio, fecha_cita=:fecha_cita, fecha_salida=:fecha_salida, fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, tipo_pasajero=:tipo_pasajero, edad=:edad, observacion=:observacion, tipo_paciente=:tipo_paciente, idpasaje_paciente_ac=:idpasaje_paciente_ac, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion WHERE id=:id;";
                DB::update($sql_pasaje, array(
                    'idpersona' => isset($params->idpersona)?$params->idpersona:null,
                    'tipo_servicio' => isset($params->tipo_servicio)?strtoupper($params->tipo_servicio):null,
                    'vuelos' => isset($params->vuelos)?strtoupper($params->vuelos):null,
                    'idruta_viaje_precio' => isset($params->idruta_viaje_precio)?$params->idruta_viaje_precio:null,
                    'fecha_cita' => isset($params->fecha_cita)?($params->fecha_cita!=""?Util::convertirStringFecha($params->fecha_cita, false):null):null,
                    'fecha_salida' => isset($params->fecha_salida)?($params->fecha_salida!=""?Util::convertirStringFecha($params->fecha_salida, false):null):null,
                    'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                    'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                    'tipo_pasajero' => isset($params->tipo_pasajero)?strtoupper($params->tipo_pasajero):null,
                    'edad' => isset($params->edad)?$params->edad:null,
                    'observacion' => isset($params->observacion)?$params->observacion:null,
                    'tipo_paciente' => isset($params->tipo_paciente)?$params->tipo_paciente:'PACIENTE',
                    'idpasaje_paciente_ac' => null,
                    'fecha_modificacion' => date('Y-m-d H:i:s'),
                    'idusuario_modificacion' => Session::get('idusuario'),
                    'id' => $params->idpasaje_paciente
                ));

                foreach ($params->detalle_acompanante as $item){
                    if (isset($item->idpasaje_paciente_acom)){
                        $sql_per_acom = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                        DB::update($sql_per_acom, array(
                            'idtipo_documento' => isset($item->idtipo_documento)?$item->idtipo_documento:1,
                            'numero_documento' => isset($item->numero_documento)?$item->numero_documento:null,
                            'apellido_paterno' => isset($item->apellido_paterno)?strtoupper($item->apellido_paterno):null,
                            'apellido_materno' => isset($item->apellido_materno)?strtoupper($item->apellido_materno):null,
                            'nombres' => isset($item->nombres)?strtoupper($item->nombres):null,
                            'sexo' => isset($item->sexo)?$item->sexo:null,
                            'telefono' => isset($item->telefono)?$item->telefono:null,
                            'fecha_nacimiento' => isset($item->fecha_nacimiento)?($item->fecha_nacimiento!=""?Util::convertirStringFecha($item->fecha_nacimiento, false):null):null,
                            'correo' => isset($item->correo)?$item->correo:null,
                            'direccion' => isset($item->direccion)?$item->direccion:null,
                            'id' => $item->idpersona
                        ));

                        $sql_pasaje = "UPDATE pasaje_paciente SET idpersona=:idpersona, tipo_servicio=:tipo_servicio, vuelos=:vuelos, idruta_viaje_precio=:idruta_viaje_precio, fecha_cita=:fecha_cita, fecha_salida=:fecha_salida, fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, tipo_pasajero=:tipo_pasajero, edad=:edad, observacion=:observacion, tipo_paciente=:tipo_paciente, idpasaje_paciente_ac=:idpasaje_paciente_ac, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion WHERE id=:id;";
                        DB::update($sql_pasaje, array(
                            'idpersona' => $item->idpersona,
                            'tipo_servicio' => isset($params->tipo_servicio)?strtoupper($params->tipo_servicio):null,
                            'vuelos' => isset($params->vuelos)?strtoupper($params->vuelos):null,
                            'idruta_viaje_precio' => isset($params->idruta_viaje_precio)?$params->idruta_viaje_precio:null,
                            'fecha_cita' => isset($params->fecha_cita)?($params->fecha_cita!=""?Util::convertirStringFecha($params->fecha_cita, false):null):null,
                            'fecha_salida' => isset($params->fecha_salida)?($params->fecha_salida!=""?Util::convertirStringFecha($params->fecha_salida, false):null):null,
                            'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                            'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                            'tipo_pasajero' => isset($item->tipo_pasajero)?strtoupper($item->tipo_pasajero):null,
                            'edad' => isset($item->edad)?$item->edad:null,
                            'observacion' => isset($item->observacion)?$item->observacion:null,
                            'tipo_paciente' => isset($item->tipo_paciente)?$item->tipo_paciente:'ACOMPAÑANTE',
                            'idpasaje_paciente_ac' => $params->idpasaje_paciente,
                            'fecha_modificacion' => date('Y-m-d H:i:s'),
                            'idusuario_modificacion' => Session::get('idusuario'),
                            'id' => $item->idpasaje_paciente_acom
                        ));
                    }else{
                        if (isset($item->idpersona)){
                            $sql_per_acom = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                            DB::update($sql_per_acom, array(
                                'idtipo_documento' => isset($item->idtipo_documento)?$item->idtipo_documento:1,
                                'numero_documento' => isset($item->numero_documento)?$item->numero_documento:null,
                                'apellido_paterno' => isset($item->apellido_paterno)?strtoupper($item->apellido_paterno):null,
                                'apellido_materno' => isset($item->apellido_materno)?strtoupper($item->apellido_materno):null,
                                'nombres' => isset($item->nombres)?strtoupper($item->nombres):null,
                                'sexo' => isset($item->sexo)?$item->sexo:null,
                                'telefono' => isset($item->telefono)?$item->telefono:null,
                                'fecha_nacimiento' => isset($item->fecha_nacimiento)?($item->fecha_nacimiento!=""?Util::convertirStringFecha($item->fecha_nacimiento, false):null):null,
                                'correo' => isset($item->correo)?$item->correo:null,
                                'direccion' => isset($item->direccion)?$item->direccion:null,
                                'id' => $item->idpersona
                            ));
                        }else{
                            $sql_per_acom = "INSERT INTO persona (idtipo_documento, numero_documento, apellido_paterno, apellido_materno, nombres, sexo, telefono, fecha_nacimiento, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                            DB::insert($sql_per_acom, [
                                isset($item->idtipo_documento)?$item->idtipo_documento:1,
                                isset($item->numero_documento)?$item->numero_documento:null,
                                isset($item->apellido_paterno)?strtoupper($item->apellido_paterno):null,
                                isset($item->apellido_materno)?strtoupper($item->apellido_materno):null,
                                isset($item->nombres)?strtoupper($item->nombres):null,
                                isset($item->sexo)?$item->sexo:null,
                                isset($item->telefono)?$item->telefono:null,
                                isset($item->fecha_nacimiento)?($item->fecha_nacimiento!=""?Util::convertirStringFecha($item->fecha_nacimiento, false):null):null,
                                isset($item->correo)?$item->correo:null,
                                isset($item->direccion)?$item->direccion:null,
                            ]);
                            $idper_acom = DB::selectOne('SELECT max(id) as id FROM persona');
                        }

                        $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                        DB::insert($sql_pasaje_acomp, [
                            isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                            isset($params->tipo_servicio)?strtoupper($params->tipo_servicio):null,
                            isset($params->vuelos)?strtoupper($params->vuelos):null,
                            isset($params->idruta_viaje_precio)?$params->idruta_viaje_precio:null,
                            isset($params->fecha_cita)?($params->fecha_cita!=""?Util::convertirStringFecha($params->fecha_cita, false):null):null,
                            isset($params->fecha_salida)?($params->fecha_salida!=""?Util::convertirStringFecha($params->fecha_salida, false):null):null,
                            isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                            isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                            isset($item->tipo_pasajero)?strtoupper($item->tipo_pasajero):null,
                            isset($item->edad)?$item->edad:null,
                            isset($params->observacion)?$params->observacion:null,
                            isset($item->tipo_paciente)?$item->tipo_paciente:'ACOMPAÑANTE',
                            $params->idpasaje_paciente,
                            date('Y-m-d H:i:s'),
                            Session::get('idusuario'),
                            null,
                            null,
                            1
                        ]);
                    }
                }
            }else{
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

                $sql_pasaje = "INSERT INTO pasaje_paciente (idpersona, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                DB::insert($sql_pasaje, [
                    isset($params->idpersona)?$params->idpersona:$idper->id,
                    isset($params->tipo_servicio)?strtoupper($params->tipo_servicio):null,
                    isset($params->vuelos)?strtoupper($params->vuelos):null,
                    isset($params->idruta_viaje_precio)?$params->idruta_viaje_precio:null,
                    isset($params->fecha_cita)?($params->fecha_cita!=""?Util::convertirStringFecha($params->fecha_cita, false):null):null,
                    isset($params->fecha_salida)?($params->fecha_salida!=""?Util::convertirStringFecha($params->fecha_salida, false):null):null,
                    isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                    isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                    isset($params->tipo_pasajero)?strtoupper($params->tipo_pasajero):null,
                    isset($params->edad)?$params->edad:null,
                    isset($params->observacion)?$params->observacion:null,
                    isset($params->tipo_paciente)?$params->tipo_paciente:'PACIENTE',
                    null,
                    date('Y-m-d H:i:s'),
                    Session::get('idusuario'),
                    null,
                    null,
                    1
                ]);

                $id_paciente = DB::selectOne("SELECT max(id) as id FROM pasaje_paciente");

                foreach ($params->detalle_acompanante as $item){
                    if (isset($item->idpersona)){
                        $sql_per_acom = "UPDATE persona SET idtipo_documento=:idtipo_documento, numero_documento=:numero_documento, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, nombres=:nombres, sexo=:sexo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, correo=:correo, direccion=:direccion WHERE id=:id;";
                        DB::update($sql_per_acom, array(
                            'idtipo_documento' => isset($item->idtipo_documento)?$item->idtipo_documento:1,
                            'numero_documento' => isset($item->numero_documento)?$item->numero_documento:null,
                            'apellido_paterno' => isset($item->apellido_paterno)?strtoupper($item->apellido_paterno):null,
                            'apellido_materno' => isset($item->apellido_materno)?strtoupper($item->apellido_materno):null,
                            'nombres' => isset($item->nombres)?strtoupper($item->nombres):null,
                            'sexo' => isset($item->sexo)?$item->sexo:null,
                            'telefono' => isset($item->telefono)?$item->telefono:null,
                            'fecha_nacimiento' => isset($item->fecha_nacimiento)?($item->fecha_nacimiento!=""?Util::convertirStringFecha($item->fecha_nacimiento, false):null):null,
                            'correo' => isset($item->correo)?$item->correo:null,
                            'direccion' => isset($item->direccion)?$item->direccion:null,
                            'id' => $item->idpersona
                        ));
                    }else{
                        $sql_per_acom = "INSERT INTO persona (idtipo_documento, numero_documento, apellido_paterno, apellido_materno, nombres, sexo, telefono, fecha_nacimiento, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                        DB::insert($sql_per_acom, [
                            isset($item->idtipo_documento)?$item->idtipo_documento:1,
                            isset($item->numero_documento)?$item->numero_documento:null,
                            isset($item->apellido_paterno)?strtoupper($item->apellido_paterno):null,
                            isset($item->apellido_materno)?strtoupper($item->apellido_materno):null,
                            isset($item->nombres)?strtoupper($item->nombres):null,
                            isset($item->sexo)?$item->sexo:null,
                            isset($item->telefono)?$item->telefono:null,
                            isset($item->fecha_nacimiento)?($item->fecha_nacimiento!=""?Util::convertirStringFecha($item->fecha_nacimiento, false):null):null,
                            isset($item->correo)?$item->correo:null,
                            isset($item->direccion)?$item->direccion:null,
                        ]);
                        $idper_acom = DB::selectOne('SELECT max(id) as id FROM persona');
                    }
                    $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    DB::insert($sql_pasaje_acomp, [
                        isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                        isset($params->tipo_servicio)?strtoupper($params->tipo_servicio):null,
                        isset($params->vuelos)?strtoupper($params->vuelos):null,
                        isset($params->idruta_viaje_precio)?$params->idruta_viaje_precio:null,
                        isset($params->fecha_cita)?($params->fecha_cita!=""?Util::convertirStringFecha($params->fecha_cita, false):null):null,
                        isset($params->fecha_salida)?($params->fecha_salida!=""?Util::convertirStringFecha($params->fecha_salida, false):null):null,
                        isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                        isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                        isset($item->tipo_pasajero)?strtoupper($item->tipo_pasajero):null,
                        isset($item->edad)?$item->edad:null,
                        isset($params->observacion)?$params->observacion:null,
                        isset($item->tipo_paciente)?$item->tipo_paciente:'ACOMPAÑANTE',
                        $id_paciente->id,
                        date('Y-m-d H:i:s'),
                        Session::get('idusuario'),
                        null,
                        null,
                        1
                    ]);
                }
            }
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function listarPasajesPaciente($params){
        $sql = "SELECT pp.id AS idpasaje_paciente, pp.idpersona, pp.vuelos, pp.idruta_viaje_precio, DATE_FORMAT(pp.fecha_cita,'%d/%m/%Y') AS fecha_cita, DATE_FORMAT(IFNULL(pp.fecha_viaje,pp.fecha_salida),'%d/%m/%Y') AS fecha_salida,
            DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, DATE_FORMAT(pp.fecha_retorno,'%d/%m/%Y') AS fecha_retorno, pp.tipo_pasajero, pp.edad, pp.observacion, pp.tipo_paciente, pp.idpasaje_paciente_ac,
            p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, DATE_FORMAT(p.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, p.telefono,
            p.correo, p.direccion, IF(pp.estado=1, 'PENDIENTE', IF(pp.estado=2,'APROVADO',IF(pp.estado=3, 'OBSERVADO', 'ELIMINADO'))) AS nom_estado, pp.estado, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE pp.estado=1";
        return DB::select($sql);
    }

    public function listarPasajesReservadosEmpresa($params){
        $sql = "SELECT pp.id AS idpasaje_paciente, pp.idpersona, pp.vuelos, pp.idruta_viaje_precio, DATE_FORMAT(pp.fecha_cita,'%d/%m/%Y') AS fecha_cita, DATE_FORMAT(IFNULL(pp.fecha_viaje,pp.fecha_salida),'%d/%m/%Y') AS fecha_salida,
            DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, DATE_FORMAT(pp.fecha_retorno,'%d/%m/%Y') AS fecha_retorno, pp.tipo_pasajero, pp.edad, pp.observacion, pp.tipo_paciente, pp.idpasaje_paciente_ac,
            p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, DATE_FORMAT(p.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, p.telefono,pp.monto_empresa,
            p.correo, p.direccion, IF(pp.estado=1, 'PENDIENTE', IF(pp.estado=2,'APROVADO',IF(pp.estado=3, 'OBSERVADO', 'ELIMINADO'))) AS nom_estado, pp.estado, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE pp.estado=1 AND pp.idempresa=1 AND pp.tipo IN (1,2)";
        return DB::select($sql);
    }

    public function guardarConfirmarReservaPasaje($params){
        try {
            $sql = "UPDATE pasaje_paciente SET fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, observacion=:observacion, monto_empresa=:monto_empresa, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
            DB::update($sql, array(
                'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                'observacion' => isset($params->observacion)?$params->observacion:null,
                'monto_empresa' => isset($params->monto_empresa)?$params->monto_empresa:null,
                'fecha_modificacion' => date('Y-m-d H:i:s'),
                'idusuario_modificacion' => Session::get('idusuario'),
                'estado' => isset($params->estado)?$params->estado:1,
                'id' => $params->idpasaje_paciente
            ));
            foreach ($params->detalle_acompanante as $item){
                $sql_acomp = "UPDATE pasaje_paciente SET fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, observacion=:observacion, monto_empresa=:monto_empresa, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                DB::update($sql_acomp, array(
                    'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                    'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                    'observacion' => isset($params->observacion)?$params->observacion:null,
                    'monto_empresa' => isset($params->monto_empresa)?$params->monto_empresa:null,
                    'fecha_modificacion' => date('Y-m-d H:i:s'),
                    'idusuario_modificacion' => Session::get('idusuario'),
                    'estado' => isset($params->estado)?$params->estado:1,
                    'id' => $item->idpasaje_paciente_acom
                ));
            }
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function obtenerListaAcompanantes($params){
        $sql = "SELECT pp.id AS idpasaje_paciente_acom, pp.idpersona, per.numero_documento, CONCAT_WS(' ',per.apellido_paterno, per.apellido_materno, per.nombres) AS nombres_persona,
            pp.edad, pp.tipo_pasajero, per.telefono FROM pasaje_paciente pp INNER JOIN persona per ON pp.idpersona=per.id
            WHERE pp.idpasaje_paciente_ac=$params->idpasaje_paciente AND pp.estado!=0";
        return DB::select($sql);
    }
}
