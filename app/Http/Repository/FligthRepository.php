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
        $sql = "SELECT id, origen, destino, CONCAT_WS(' - ',origen,destino) AS nom_ruta, precio_adulto_venta, precio_infante_venta, precio_ninio_venta, precio_adulto_compra, precio_infante_compra, precio_ninio_compra FROM ruta_viaje_precio WHERE estado=1";
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

                $sql_pasaje = "UPDATE pasaje_paciente SET idpersona=:idpersona, idempresa=:idempresa, tipo=:tipo, tipo_servicio=:tipo_servicio, vuelos=:vuelos, idruta_viaje_precio=:idruta_viaje_precio, fecha_cita=:fecha_cita, fecha_salida=:fecha_salida, fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, tipo_pasajero=:tipo_pasajero, edad=:edad, observacion=:observacion, tipo_paciente=:tipo_paciente, idpasaje_paciente_ac=:idpasaje_paciente_ac,
                           monto_empresa=:monto_empresa, codigo_generado=:codigo_generado, codigo=:codigo, unidad_medida=:unidad_medida, cantidad=:cantidad, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                DB::update($sql_pasaje, array(
                    'idpersona' => isset($params->idpersona)?$params->idpersona:null,
                    'idempresa' => (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                    'tipo' => Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                    'monto_empresa' => isset($params->monto_empresa)?($params->monto_empresa!=""?$params->monto_empresa:null):null,
                    'codigo_generado' => isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                    'codigo' => isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                    'unidad_medida' => isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:null):null,
                    'cantidad' => isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:null):null,
                    'precio_unitario' => isset($params->precio_unitario)?($params->precio_unitario!=""?$params->precio_unitario:null):null,
                    'fecha_modificacion' => date('Y-m-d H:i:s'),
                    'idusuario_modificacion' => Session::get('idusuario'),
                    'estado' => isset($params->estado)?($params->estado!=""?$params->estado:1):1,
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

                        $sql_pasaje = "UPDATE pasaje_paciente SET idpersona=:idpersona, idempresa=:idempresa, tipo=:tipo, tipo_servicio=:tipo_servicio, vuelos=:vuelos, idruta_viaje_precio=:idruta_viaje_precio, fecha_cita=:fecha_cita, fecha_salida=:fecha_salida, fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, tipo_pasajero=:tipo_pasajero, edad=:edad, observacion=:observacion, tipo_paciente=:tipo_paciente, idpasaje_paciente_ac=:idpasaje_paciente_ac, monto_empresa=:monto_empresa, codigo_generado=:codigo_generado, codigo=:codigo, unidad_medida=:unidad_medida, cantidad=:cantidad, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                        DB::update($sql_pasaje, array(
                            'idpersona' => $item->idpersona,
                            'idempresa' => (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                            'tipo' => Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                            'monto_empresa' => isset($params->monto_empresa)?($params->monto_empresa!=""?$params->monto_empresa:null):null,
                            'codigo_generado' => isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                            'codigo' => isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                            'unidad_medida' => isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:null):null,
                            'cantidad' => isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:null):null,
                            'precio_unitario' => isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                            'fecha_modificacion' => date('Y-m-d H:i:s'),
                            'idusuario_modificacion' => Session::get('idusuario'),
                            'estado' => isset($params->estado)?($params->estado!=""?$params->estado:1):1,
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

                        $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, idempresa, tipo, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, monto_empresa, codigo_generado, codigo, unidad_medida, cantidad, precio_unitario, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                        DB::insert($sql_pasaje_acomp, [
                            isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                            (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                            Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                            isset($item->monto_empresa)?($item->monto_empresa!=""?$item->monto_empresa:null):null,
                            isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                            isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                            isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:'NIU'):'NIU',
                            isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:1):1,
                            isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                            date('Y-m-d H:i:s'),
                            Session::get('idusuario'),
                            null,
                            null,
                            1
                        ]);
                    }
                }

                foreach ($params->detalle_personal as $item){
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

                        $sql_pasaje = "UPDATE pasaje_paciente SET idpersona=:idpersona, idempresa=:idempresa, tipo=:tipo, tipo_servicio=:tipo_servicio, vuelos=:vuelos, idruta_viaje_precio=:idruta_viaje_precio, fecha_cita=:fecha_cita, fecha_salida=:fecha_salida, fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, tipo_pasajero=:tipo_pasajero, edad=:edad, observacion=:observacion, tipo_paciente=:tipo_paciente, idpasaje_paciente_ac=:idpasaje_paciente_ac, monto_empresa=:monto_empresa, codigo_generado=:codigo_generado, codigo=:codigo, unidad_medida=:unidad_medida, cantidad=:cantidad, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                        DB::update($sql_pasaje, array(
                            'idpersona' => $item->idpersona,
                            'idempresa' => (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                            'tipo' => Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                            'tipo_paciente' => 'PERSONAL DE SALUD',
                            'idpasaje_paciente_ac' => $params->idpasaje_paciente,
                            'monto_empresa' => isset($item->monto_empresa)?($item->monto_empresa!=""?$item->monto_empresa:null):null,
                            'codigo_generado' => isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                            'codigo' => isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                            'unidad_medida' => isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:null):null,
                            'cantidad' => isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:null):null,
                            'precio_unitario' => isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                            'fecha_modificacion' => date('Y-m-d H:i:s'),
                            'idusuario_modificacion' => Session::get('idusuario'),
                            'estado' => isset($params->estado)?($params->estado!=""?$params->estado:1):1,
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

                        $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, idempresa, tipo, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, monto_empresa, codigo_generado, codigo, unidad_medida, cantidad, precio_unitario, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                        DB::insert($sql_pasaje_acomp, [
                            isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                            (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                            Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                            'PERSONAL DE SALUD',
                            $params->idpasaje_paciente,
                            isset($params->monto_empresa)?($params->monto_empresa!=""?$params->monto_empresa:null):null,
                            isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                            isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                            isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:'NIU'):'NIU',
                            isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:1):1,
                            isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                            date('Y-m-d H:i:s'),
                            Session::get('idusuario'),
                            null,
                            null,
                            1
                        ]);
                    }
                }
                $data['idpasaje_paciente'] = $params->idpasaje_paciente;
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

                $sql_pasaje = "INSERT INTO pasaje_paciente (idpersona, idempresa, tipo, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, monto_empresa, codigo_generado, codigo, unidad_medida, cantidad, precio_unitario, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                DB::insert($sql_pasaje, [
                    isset($params->idpersona)?$params->idpersona:$idper->id,
                    (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                    Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                    isset($params->monto_empresa)?($params->monto_empresa!=""?$params->monto_empresa:null):null,
                    isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                    isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                    isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:'NIU'):'NIU',
                    isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:1):1,
                    isset($params->precio_unitario)?($params->precio_unitario!=""?$params->precio_unitario:null):null,
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
                    $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, idempresa, tipo, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, monto_empresa, codigo_generado, codigo, unidad_medida, cantidad, precio_unitario, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    DB::insert($sql_pasaje_acomp, [
                        isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                        (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                        Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                        isset($item->monto_empresa)?($item->monto_empresa!=""?$item->monto_empresa:null):null,
                        isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                        isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                        isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:'NIU'):'NIU',
                        isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:1):1,
                        isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                        date('Y-m-d H:i:s'),
                        Session::get('idusuario'),
                        null,
                        null,
                        1
                    ]);
                }

                foreach ($params->detalle_personal as $item){
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
                    $sql_pasaje_acomp = "INSERT INTO pasaje_paciente (idpersona, idempresa, tipo, tipo_servicio, vuelos, idruta_viaje_precio, fecha_cita, fecha_salida, fecha_viaje, fecha_retorno, tipo_pasajero, edad, observacion, tipo_paciente, idpasaje_paciente_ac, monto_empresa, codigo_generado, codigo, unidad_medida, cantidad, precio_unitario, fecha_registro, idusuario, fecha_modificacion, idusuario_modificacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    DB::insert($sql_pasaje_acomp, [
                        isset($item->idpersona)?$item->idpersona:$idper_acom->id,
                        (Session::get('idnivel') == 2?(isset($params->tipo_servicio)?($params->tipo_servicio=='PASAJE AEREO'?1:null):null):(isset($params->idempresa)?($params->idempresa!=""?$params->idempresa:null):null)),
                        Session::get('idnivel')==2?($params->tipo_servicio=='PASAJE AEREO'?1:null):isset($params->tipo)?$params->tipo:null,
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
                        'PERSONAL DE SALUD',
                        $id_paciente->id,
                        isset($item->monto_empresa)?($item->monto_empresa!=""?$item->monto_empresa:null):null,
                        isset($params->codigo_generado)?($params->codigo_generado!=""?$params->codigo_generado:null):null,
                        isset($params->codigo)?($params->codigo!=""?$params->codigo:null):null,
                        isset($params->unidad_medida)?($params->unidad_medida!=""?$params->unidad_medida:'NIU'):'NIU',
                        isset($params->cantidad)?($params->cantidad!=""?$params->cantidad:1):1,
                        isset($item->precio_unitario)?($item->precio_unitario!=""?$item->precio_unitario:null):null,
                        date('Y-m-d H:i:s'),
                        Session::get('idusuario'),
                        null,
                        null,
                        1
                    ]);
                }

                $data['idpasaje_paciente'] = $id_paciente->id;
            }
           /* $id_paciente = DB::selectOne("SELECT max(id) as id FROM pasaje_paciente");
            $data['idpasaje_paciente'] = $id_paciente->id;*/
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function guardarArchivosPaciente($params){
        try {
            /*if (isset($params->idpaciente_archivo)){
                //
            }else{

            }*/
            $sql = "INSERT INTO paciente_archivos (idpasaje_paciente, nombre_archivo, extension_archivo, numero_archivo, fecha_creacion, estado) VALUES (?, ?, ?, ?, ?, ?);";
            DB::insert($sql, [$params->idpasaje_paciente, $params->nombre_archivo, $params->extension_archivo, $params->numero_archivo, date('Y-m-d H:i:s'), 1]);
            return true;
        }catch (Exception $ex){
            return false;
        }
    }

    public function listarPasajesPaciente($params){
        $sql = "SELECT pp.id AS idpasaje_paciente, pp.idpersona, pp.tipo, pp.vuelos, pp.idruta_viaje_precio, DATE_FORMAT(pp.fecha_cita,'%d/%m/%Y') AS fecha_cita, DATE_FORMAT(IFNULL(pp.fecha_viaje,pp.fecha_salida),'%d/%m/%Y') AS fecha_salida,
            DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, DATE_FORMAT(pp.fecha_retorno,'%d/%m/%Y') AS fecha_retorno, pp.tipo_pasajero, pp.edad, pp.observacion, pp.tipo_paciente, pp.idpasaje_paciente_ac, pp.codigo, pp.codigo_generado,
            p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, DATE_FORMAT(p.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, p.telefono,pp.monto_empresa, pp.idempresa, pp.unidad_medida, pp.cantidad, pp.precio_unitario,
            p.correo, p.direccion, IF(pp.estado=1, 'PENDIENTE', IF(pp.estado=2,'APROVADO',IF(pp.estado=3, 'OBSERVADO', 'ELIMINADO'))) AS nom_estado, pp.estado, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino, rvp.origen, rvp.destino
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE (pp.tipo IN (1,2) OR pp.tipo is null)".
            (isset($params->estado)?($params->estado!=""?" AND pp.estado=$params->estado":""):"").
            (isset($params->numero_documento)?($params->numero_documento!=""?" AND p.numero_documento='$params->numero_documento'":""):"").
            (isset($params->fecha_inicio)?($params->fecha_inicio!=""?(isset($params->fecha_final)?($params->fecha_final!=""?" AND pp.fecha_cita BETWEEN '".Util::convertirStringFecha($params->fecha_inicio, false)."' AND '".Util::convertirStringFecha($params->fecha_final, false)."'":""):""):""):"");
        return DB::select($sql);
    }

    public function listarPasajesReservadosEmpresa($params){
        $sql = "SELECT pp.id AS idpasaje_paciente, pp.idpersona, pp.vuelos, pp.idruta_viaje_precio, DATE_FORMAT(pp.fecha_cita,'%d/%m/%Y') AS fecha_cita, DATE_FORMAT(IFNULL(pp.fecha_viaje,pp.fecha_salida),'%d/%m/%Y') AS fecha_salida,
            DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, DATE_FORMAT(pp.fecha_retorno,'%d/%m/%Y') AS fecha_retorno, pp.tipo_pasajero, pp.edad, pp.observacion, pp.tipo_paciente, pp.idpasaje_paciente_ac, pp.codigo, pp.codigo_generado,
            p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, DATE_FORMAT(p.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, p.telefono,pp.monto_empresa, pp.idempresa, pp.unidad_medida, pp.cantidad, pp.precio_unitario,
            p.correo, p.direccion, IF(pp.estado=1, 'PENDIENTE', IF(pp.estado=2,'APROVADO',IF(pp.estado=3, 'OBSERVADO', 'ELIMINADO'))) AS nom_estado, pp.estado, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE pp.tipo IN (1,2) ".
            (isset($params->estado)?($params->estado!=""?" AND pp.estado=$params->estado ":" AND pp.estado!=0 "):" AND pp.estado!=0 ").
            (Session::get('idnivel')==1?"":" AND pp.idempresa=".Session::get('idempresa')).
            (isset($params->numero_documento)?($params->numero_documento!=""?" AND p.numero_documento='$params->numero_documento'":""):"").
            (isset($params->fecha_inicio)?($params->fecha_inicio!=""?(isset($params->fecha_final)?($params->fecha_final!=""?" AND pp.fecha_viaje BETWEEN '".Util::convertirStringFecha($params->fecha_inicio, false)."' AND '".Util::convertirStringFecha($params->fecha_final, false)."'":""):""):""):"");
        return DB::select($sql);
    }

    public function guardarConfirmarReservaPasaje($params){
        try {
            $sql = "UPDATE pasaje_paciente SET fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, observacion=:observacion, monto_empresa=:monto_empresa, idempresa=:idempresa, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
            DB::update($sql, array(
                'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                'observacion' => isset($params->observacion)?$params->observacion:null,
                'monto_empresa' => isset($params->monto_empresa)?$params->monto_empresa:null,
                'idempresa' => isset($params->idempresa)?$params->idempresa:null,
                'precio_unitario' => isset($params->precio_unitario)?$params->precio_unitario:null,
                'fecha_modificacion' => date('Y-m-d H:i:s'),
                'idusuario_modificacion' => Session::get('idusuario'),
                'estado' => isset($params->estado)?$params->estado:1,
                'id' => $params->idpasaje_paciente
            ));
            foreach ($params->detalle_acompanante as $item){
                $sql_acomp = "UPDATE pasaje_paciente SET fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, observacion=:observacion, monto_empresa=:monto_empresa, idempresa=:idempresa, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                DB::update($sql_acomp, array(
                    'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                    'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                    'observacion' => isset($params->observacion)?$params->observacion:null,
                    'monto_empresa' => ($params->tipo_servicio == 'VUELO CHARTER'?0:(isset($params->monto_empresa)?$params->monto_empresa:null)),
                    'idempresa' => isset($params->idempresa)?$params->idempresa:null,
                    'precio_unitario' => ($params->tipo_servicio == 'VUELO CHARTER'?0:(isset($params->precio_unitario)?$params->precio_unitario:null)),
                    'fecha_modificacion' => date('Y-m-d H:i:s'),
                    'idusuario_modificacion' => Session::get('idusuario'),
                    'estado' => isset($params->estado)?$params->estado:1,
                    'id' => $item->idpasaje_paciente_acom
                ));
            }

            foreach ($params->detalle_personal as $item){
                $sql_acomp = "UPDATE pasaje_paciente SET fecha_viaje=:fecha_viaje, fecha_retorno=:fecha_retorno, observacion=:observacion, monto_empresa=:monto_empresa, idempresa=:idempresa, precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion, estado=:estado WHERE id=:id;";
                DB::update($sql_acomp, array(
                    'fecha_viaje' => isset($params->fecha_viaje)?($params->fecha_viaje!=""?Util::convertirStringFecha($params->fecha_viaje, false):null):null,
                    'fecha_retorno' => isset($params->fecha_retorno)?($params->fecha_retorno!=""?Util::convertirStringFecha($params->fecha_retorno, false):null):null,
                    'observacion' => isset($params->observacion)?$params->observacion:null,
                    'monto_empresa' => 0,
                    'idempresa' => isset($params->idempresa)?$params->idempresa:null,
                    'precio_unitario' => ($params->tipo_servicio == 'VUELO CHARTER'?0:(isset($params->precio_unitario)?$params->precio_unitario:null)),
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
        $sql = "SELECT pp.id AS idpasaje_paciente_acom, pp.idpersona, per.numero_documento, CONCAT_WS(' ',per.apellido_paterno, per.apellido_materno, per.nombres) AS nombres_persona, per.apellido_paterno, per.apellido_materno, per.nombres,
            pp.edad, pp.tipo_pasajero, per.telefono, pp.unidad_medida, pp.cantidad, pp.precio_unitario, pp.monto_empresa FROM pasaje_paciente pp INNER JOIN persona per ON pp.idpersona=per.id
            WHERE pp.idpasaje_paciente_ac=$params->idpasaje_paciente AND pp.tipo_paciente='ACOMPAÑANTE' AND pp.estado!=0";
        return DB::select($sql);
    }

    public function obtenerListaPersonalSalud($params){
        $sql = "SELECT pp.id AS idpasaje_paciente_acom, pp.idpersona, per.numero_documento, CONCAT_WS(' ',per.apellido_paterno, per.apellido_materno, per.nombres) AS nombres_persona, per.apellido_paterno, per.apellido_materno, per.nombres,
            pp.edad, pp.tipo_pasajero, per.telefono, pp.unidad_medida, pp.cantidad, pp.precio_unitario FROM pasaje_paciente pp INNER JOIN persona per ON pp.idpersona=per.id
            WHERE pp.idpasaje_paciente_ac=$params->idpasaje_paciente AND pp.tipo_paciente='PERSONAL DE SALUD' AND pp.estado!=0";
        return DB::select($sql);
    }

    public function listarPasajesReservados($params){
        $sql = "SELECT pp.id AS idpasaje_paciente, pp.idpersona, pp.vuelos, pp.idruta_viaje_precio, DATE_FORMAT(pp.fecha_cita,'%d/%m/%Y') AS fecha_cita, DATE_FORMAT(IFNULL(pp.fecha_viaje,pp.fecha_salida),'%d/%m/%Y') AS fecha_salida,
            DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, DATE_FORMAT(pp.fecha_retorno,'%d/%m/%Y') AS fecha_retorno, pp.tipo_pasajero, pp.edad, pp.observacion, pp.tipo_paciente, pp.idpasaje_paciente_ac,
            p.idtipo_documento, p.numero_documento, p.apellido_paterno, p.apellido_materno, p.nombres, p.sexo, DATE_FORMAT(p.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, p.telefono,pp.monto_empresa, pp.idempresa,
            p.correo, p.direccion, IF(pp.estado=1, 'PENDIENTE', IF(pp.estado=2,'APROVADO',IF(pp.estado=3, 'OBSERVADO', 'ELIMINADO'))) AS nom_estado, pp.estado, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino,
            pp.unidad_medida, pp.cantidad, pp.precio_unitario
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE (pp.tipo IN (1,2) OR pp.tipo IS NULL) ".
            (isset($params->estado)?($params->estado!=""?" AND pp.estado=$params->estado ":" AND pp.estado!=0 "):" AND pp.estado!=0 ").
            (isset($params->numero_documento)?($params->numero_documento!=""?" AND p.numero_documento='$params->numero_documento'":""):"").
            (isset($params->tipo_servicio)?($params->tipo_servicio!=""?" AND pp.tipo_servicio='$params->tipo_servicio'":""):"").
            (isset($params->idruta_viaje_precio)?($params->idruta_viaje_precio!=""?" AND pp.idruta_viaje_precio=$params->idruta_viaje_precio":""):"").
            (isset($params->fecha_inicio)?($params->fecha_inicio!=""?(isset($params->fecha_final)?($params->fecha_final!=""?" AND pp.fecha_cita BETWEEN '".Util::convertirStringFecha($params->fecha_inicio, false)."' AND '".Util::convertirStringFecha($params->fecha_final, false)."'":""):""):""):"");
        return DB::select($sql);
    }

    public function eliminarPasaje($params){
        try {
            $sql = "UPDATE pasaje_paciente SET estado=0 where id=:id";
            DB::update($sql, array('id' => $params->idpasaje_paciente));
            $sql_acomp = "UPDATE pasaje_paciente SET estado=0 where idpasaje_paciente_ac=:id";
            DB::update($sql_acomp, array('id' => $params->idpasaje_paciente));
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function listarProformas($params){
        if ($params->tipo_servicio == 'PASAJE AEREO'){
            //vuelos pasajes
            $sql = "SELECT pp.id AS idpasaje_paciente,DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y') AS fecha_viaje, pp.tipo_pasajero, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino, pp.tipo_paciente,p.idtipo_documento, p.numero_documento,
                p.apellido_paterno, p.apellido_materno, p.nombres, p.telefono, pp.monto_empresa, IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' ','SERVICIO',pp.tipo_servicio,'EN LA RUTA',CONCAT_WS(' - ',rvp.origen,rvp.destino),'(',p.apellido_paterno,p.apellido_materno,p.nombres,'-',pp.tipo_pasajero,')','-','FECHA DE VIAJE', DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y')),
                CONCAT_WS(' ',pp.tipo_servicio,CONCAT_WS(' - ',rvp.origen,rvp.destino),'(',p.apellido_paterno,p.apellido_materno,p.nombres,'-',pp.tipo_pasajero,')','-','FECHA DE VIAJE', DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y'))) AS descripcion, pp.unidad_medida, pp.cantidad, pp.precio_unitario, (pp.precio_unitario * pp.cantidad) as total,
                IF(pp.tipo_servicio='VUELO CHARTER','SERVICIO VUELO CHARTER EN LA', CONCAT_WS(' ',pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino))) AS descrip_1,
                IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' ','RUTA ', CONCAT_WS(' - ',rvp.origen,rvp.destino)), CONCAT_WS(' ','(',p.apellido_paterno,p.apellido_materno,p.nombres,IF(pp.tipo_pasajero='ADULTO','', CONCAT(' - ',pp.tipo_pasajero)),')','-')) AS descrip_2,
                IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' - ','',rvp.origen), CONCAT_WS(' ','FECHA DE VIAJE', DATE_FORMAT(pp.fecha_viaje,'%d/%m/%Y'))) AS descrip_3

             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE pp.tipo IN (1,2) AND pp.estado=2 AND pp.tipo_servicio='PASAJE AEREO' ".
                (isset($params->idruta_viaje_precio)?($params->idruta_viaje_precio!=""?" AND pp.idruta_viaje_precio=$params->idruta_viaje_precio":""):"").
                (isset($params->fecha_inicio)?($params->fecha_inicio!=""?(isset($params->fecha_final)?($params->fecha_final!=""?" AND pp.fecha_cita BETWEEN '".Util::convertirStringFecha($params->fecha_inicio, false)."' AND '".Util::convertirStringFecha($params->fecha_final, false)."'":""):""):""):"");
        }else{
            //charter
            $sql = "SELECT pp.id as idpasaje_paciente, pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino) AS nomb_origen_destino,
                IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' ','SERVICIO',pp.tipo_servicio,'EN LA RUTA',CONCAT_WS(' - ',rvp.origen,rvp.destino)),'') AS descripcion, pp.unidad_medida, pp.cantidad, pp.precio_unitario, (pp.precio_unitario * pp.cantidad) as total,
                IF(pp.tipo_servicio='VUELO CHARTER','SERVICIO VUELO CHARTER EN LA', CONCAT_WS(' ',pp.tipo_servicio, CONCAT_WS(' - ',rvp.origen,rvp.destino))) AS descrip_1,
                IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' ','RUTA ', CONCAT_WS(' - ',rvp.origen,rvp.destino)), '') AS descrip_2,
                IF(pp.tipo_servicio='VUELO CHARTER',CONCAT_WS(' - ','',rvp.origen),'') AS descrip_3
             FROM pasaje_paciente pp INNER JOIN persona p ON pp.idpersona=p.id
             INNER JOIN ruta_viaje_precio rvp ON pp.idruta_viaje_precio=rvp.id
            WHERE pp.tipo IN (1,2) AND pp.estado=2 AND pp.tipo_servicio='VUELO CHARTER' AND pp.tipo_paciente='PACIENTE' ".
                (isset($params->idruta_viaje_precio)?($params->idruta_viaje_precio!=""?" AND pp.idruta_viaje_precio=$params->idruta_viaje_precio":""):"").
                (isset($params->fecha_inicio)?($params->fecha_inicio!=""?(isset($params->fecha_final)?($params->fecha_final!=""?" AND pp.fecha_cita BETWEEN '".Util::convertirStringFecha($params->fecha_inicio, false)."' AND '".Util::convertirStringFecha($params->fecha_final, false)."'":""):""):""):"");
        }

        return DB::select($sql);
    }

    public function obtenerDocumentosById($params){
        $sql = "SELECT id, idpasaje_paciente, nombre_archivo, extension_archivo, numero_archivo
            FROM paciente_archivos WHERE estado=1 AND idpasaje_paciente=$params->idpasaje_paciente";
        return DB::select($sql);
    }

    public function generarCodigoTicket(){
        $sql = "SELECT (IFNULL(MAX(codigo),0) + 1) AS codigo, LPAD((IFNULL(MAX(codigo),0) + 1),6,'0') AS codigo_generado FROM pasaje_paciente ";
        return DB::selectOne($sql);
    }

    public function guardarOficioProforma($params){
        try {
            //
            $sql = "INSERT INTO oficio (nombre_anio, nro_oficio, anio, fecha_inicio, nom_ruta, fecha_final, precio_total, nro_factura, fecha_generado, idusuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            DB::insert($sql, [
                isset($params->nombre_anio)?($params->nombre_anio!=""?$params->nombre_anio:null):null,
                isset($params->nro_oficio)?($params->nro_oficio!=""?$params->nro_oficio:null):null,
                date('Y'),
                isset($params->fecha_inicio)?($params->fecha_inicio!=""?Util::convertirStringFecha($params->fecha_inicio, false):null):null,
                isset($params->nom_ruta)?($params->nom_ruta!=""?$params->nom_ruta:null):null,
                isset($params->fecha_final)?($params->fecha_final!=""?Util::convertirStringFecha($params->fecha_final, false):null):null,
                isset($params->precio_total)?($params->precio_total!=""?$params->precio_total:0):0,
                isset($params->nro_factura)?($params->nro_factura!=""?$params->nro_factura:null):null,
                date('Y-m-d H:i:s'),
                Session::get('idusuario')
            ]);
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function guardarActaConformidadProforma($params){
        try {
            //
            $sql = "INSERT INTO acta_conformidad (fecha_inicio, nom_ruta, fecha_final, precio_total, fecha_generado, idusuario) VALUES (?, ?, ?, ?, ?, ?);";
            DB::insert($sql, [
                isset($params->fecha_inicio)?($params->fecha_inicio!=""?Util::convertirStringFecha($params->fecha_inicio, false):null):null,
                isset($params->nom_ruta)?($params->nom_ruta!=""?$params->nom_ruta:null):null,
                isset($params->fecha_final)?($params->fecha_final!=""?Util::convertirStringFecha($params->fecha_final, false):null):null,
                isset($params->precio_total)?($params->precio_total!=""?$params->precio_total:0):0,
                date('Y-m-d H:i:s'),
                Session::get('idusuario')
            ]);
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function guardarMontoAsignado($params){
        try {
            //
            $sql = "UPDATE pasaje_paciente SET precio_unitario=:precio_unitario, fecha_modificacion=:fecha_modificacion, idusuario_modificacion=:idusuario_modificacion WHERE id=:id;";
            DB::update($sql, array(
                'precio_unitario' => $params->precio_unitario,
                'fecha_modificacion' => date('Y-m-d H:i:s'),
                'idusuario_modificacion' => Session::get('idusuario'),
                'id' => $params->idpasaje_paciente,
            ));
            $data['confirm'] = true;
            return $data;
        }catch (Exception $ex){
            $data['confirm'] = false;
            return $data;
        }
    }

    public function obtenerDatosGeneradosOficio($params){
        $anio = date('Y');
        $sql_oficio = "SELECT (IFNULL(MAX(nro_oficio),0) + 1) AS numero_oficio FROM oficio";
        $result_oficio = DB::selectOne($sql_oficio);
        $sql_nom_anio = "SELECT nom_anio FROM nombre_anio_actual WHERE anio='$anio'";
        $result_nom_anio = DB::selectOne($sql_nom_anio);
        $data['anio'] = $anio;
        $data['nro_oficio'] = $result_oficio->numero_oficio;
        $data['nombre_anio'] = $result_nom_anio->nom_anio;
        return $data;
    }
}
