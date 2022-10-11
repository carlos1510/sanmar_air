<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 7/09/2018
 * Time: 04:24
 */

namespace App\Http\Util;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class Util
{

    public static function convertirStringFecha($stringfecha,$conHoras = false, $lenguaje_origen= "ES", $lenguaje_destino= "EN"  ){
        //por defecto d/m/Y
        $response="";

        if(!is_null($stringfecha)){
            if(trim($stringfecha)!=""){
                if($lenguaje_origen=="ES" && $lenguaje_destino=="EN"){
                    $horas="";
                    if($conHoras) {
                        $th=explode(" ",$stringfecha);
                        $stringfecha = $th[0];
                        $horas=" ".$th[1];
                    }
                    $t=explode("/",$stringfecha);
                    $response=$t[2]."-".$t[1]."-".$t[0].$horas;
                }
            }
        }
        return $response;
    }

    public static function getUltimoDiaMes($elAnio, $elMes) {
        return date("Y-m-d",(mktime(0, 0, 0, $elMes+1, 1, $elAnio)-1));
    }

    public static function nombremes($mes){
        setlocale(LC_TIME, 'spanish');
        $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
        return $nombre;
    }

    public static function semanas($fecha1, $fecha2)
    {
        /*$divide_ini = explode("-", $fecha1);
        $divide_fin = explode("-", $fecha2);

        $fecha_ini = mktime(0, 0, $divide_ini[0], $divide_ini[1], $divide_ini[2]);
        $fecha_fin = mktime(0, 0, $divide_fin[0], $divide_fin[1], $divide_fin[2]);

        $segundos = $fecha_ini - $fecha_fin; // Obtenemos los segundos entre esas dos fechas
        $segundos = abs($segundos); //en caso de errores
        $semanas = floor($segundos / 604800); //Obtenemos las semanas entre esas fechas.*/

        $segundosxsemana = 604800;
        /*$t=explode("-",$fecha1);
        $diafum = $t[2];
        $mesfum = $t[1];
        $aniofum = $t[0];
        $t2 = explode($fecha2);
        $dia_act = $t2[2];
        $mes_act = $t2[1];
        $anio_act = $t2[0];
        for($i=$mesfum; $i<=$mes_act;$i++){
            if($i == $mesfum){
                $valor_mes[] = (int)$mesfum - (int)$diafum;
            }else{
                if($i == $mes_act){
                    $valor_mes[] = (int)$dia_act;
                }else{
                    $valor_mes[] = date("d",(mktime(0, 0, 0, $mes_act+1, 1, $anio_act)-1));
                }
            }
        }*/
        //date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
        $segundos = abs(strtotime($fecha2) - strtotime($fecha1));
        $semanas = floor($segundos/$segundosxsemana);
        /*$datetime1 = new \DateTime($fecha1);
        $datetime2 = new \DateTime($fecha2);
        $interval = $datetime1->diff($datetime2);
        $semanas = floor(($interval->format('%a') / 7));*/
        return $semanas;
    }

    public static function getCantidades($datos, $data_nom){
        $nombre="";
        $mes1=0;$mes2=0;$mes3=0;$mes4=0;$mes5=0;$mes6=0;$mes7=0;$mes8=0;$mes9=0;$mes10=0;$mes11=0;$mes12=0;
        $data = array();
        $i=0;
        foreach($data_nom as $value){
            $mes1=0;$mes2=0;$mes3=0;$mes4=0;$mes5=0;$mes6=0;$mes7=0;$mes8=0;$mes9=0;$mes10=0;$mes11=0;$mes12=0;
            $nombre = "";
            foreach($datos as $item){
                if(isset($value->nombre)){
                    $nombre = $value->nombre;
                    if($value->nombre == $item->nombre){
                        if($item->mes == '1'){
                            $mes1=$item->total;
                        }else{
                            if($item->mes == '2'){
                                $mes2=$item->total;
                            }else{
                                if($item->mes == '3'){
                                    $mes3=$item->total;
                                }else{
                                    if($item->mes == '4'){
                                        $mes4=$item->total;
                                    }else{
                                        if($item->mes == '5'){
                                            $mes5=$item->total;
                                        }else{
                                            if($item->mes == '6'){
                                                $mes6=$item->total;
                                            }else{
                                                if($item->mes == '7'){
                                                    $mes7=$item->total;
                                                }else{
                                                    if($item->mes == '8'){
                                                        $mes8=$item->total;
                                                    }else{
                                                        if($item->mes == '9'){
                                                            $mes9=$item->total;
                                                        }else{
                                                            if($item->mes == '10'){
                                                                $mes10=$item->total;
                                                            }else{
                                                                if($item->mes == '11'){
                                                                    $mes11=$item->total;
                                                                }else{
                                                                    if($item->mes == '12'){
                                                                        $mes12=$item->total;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $nombre = $value;
                    if($value == $item->nombre){
                        if($item->mes == '1'){
                            $mes1=$item->total;
                        }else{
                            if($item->mes == '2'){
                                $mes2=$item->total;
                            }else{
                                if($item->mes == '3'){
                                    $mes3=$item->total;
                                }else{
                                    if($item->mes == '4'){
                                        $mes4=$item->total;
                                    }else{
                                        if($item->mes == '5'){
                                            $mes5=$item->total;
                                        }else{
                                            if($item->mes == '6'){
                                                $mes6=$item->total;
                                            }else{
                                                if($item->mes == '7'){
                                                    $mes7=$item->total;
                                                }else{
                                                    if($item->mes == '8'){
                                                        $mes8=$item->total;
                                                    }else{
                                                        if($item->mes == '9'){
                                                            $mes9=$item->total;
                                                        }else{
                                                            if($item->mes == '10'){
                                                                $mes10=$item->total;
                                                            }else{
                                                                if($item->mes == '11'){
                                                                    $mes11=$item->total;
                                                                }else{
                                                                    if($item->mes == '12'){
                                                                        $mes12=$item->total;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data[$i] = array('nombre'=>$nombre,
                'mes1'=> (int) $mes1, 'mes2'=> (int) $mes2, 'mes3'=> (int) $mes3, 'mes4'=> (int) $mes4, 'mes5'=> (int) $mes5, 'mes6'=> (int) $mes6, 'mes7'=> (int) $mes7, 'mes8'=> (int) $mes8,
                'mes9'=> (int) $mes9, 'mes10'=> (int) $mes10, 'mes11'=> (int) $mes11, 'mes12'=> (int) $mes12);
            $i++;
        }
        return $data;
    }

    /*public static function getCantidadMensualEESS($datos, $eessarray){
        $mes1=0;$mes2=0;$mes3=0;$mes4=0;$mes5=0;$mes6=0;$mes7=0;$mes8=0;$mes9=0;$mes10=0;$mes11=0;$mes12=0;
        $ultima_fecha="";$nombre_eess="";
        $data = array();
        $i=0;
        foreach($eessarray as $eess){
            $mes1=0;$mes2=0;$mes3=0;$mes4=0;$mes5=0;$mes6=0;$mes7=0;$mes8=0;$mes9=0;$mes10=0;$mes11=0;$mes12=0;
            $ultima_fecha="";$nombre_eess="";
            foreach($datos as $item){
                if($item->establecimiento == $eess->establecimiento){
                    $ultima_fecha = $item->ultima_fecha;
                    $nombre_eess = $item->nom_est;
                    if($item->mes == 1){
                        $mes1++;
                    }else{
                        if($item->mes == 2){
                            $mes2++;
                        }else{
                            if($item->mes == 3){
                                $mes3++;
                            }else{
                                if($item->mes == 4){
                                    $mes4++;
                                }else{
                                    if($item->mes == 5){
                                        $mes5++;
                                    }else{
                                        if($item->mes == 6){
                                            $mes6++;
                                        }else{
                                            if($item->mes == 7){
                                                $mes7++;
                                            }else{
                                                if($item->mes == 8){
                                                    $mes8++;
                                                }else{
                                                    if($item->mes == 9){
                                                        $mes9++;
                                                    }else{
                                                        if($item->mes == 10){
                                                            $mes10++;
                                                        }else{
                                                            if($item->mes == 11){
                                                                $mes11++;
                                                            }else{
                                                                if($item->mes == 12){
                                                                    $mes12++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data[$i] = array('establecimiento'=>$eess->establecimiento, 'nom_eess'=>$eess->nom_est, 'ultima_fecha'=>$ultima_fecha,
                'mes1'=> (int) $mes1, 'mes2'=> (int) $mes2, 'mes3'=> (int) $mes3, 'mes4'=> (int) $mes4, 'mes5'=> (int) $mes5, 'mes6'=> (int) $mes6, 'mes7'=> (int) $mes7, 'mes8'=> (int) $mes8,
                'mes9'=> (int) $mes9, 'mes10'=> (int) $mes10, 'mes11'=> (int) $mes11, 'mes12'=> (int) $mes12);
            $i++;
        }
        return $data;

    }*/

    public static function obtenerExamenGestanteByTipo($idgestante, $fecha, $tipo_examen, $idresponsable){
        $sql = "SELECT * FROM salud_materno.gestante_examen WHERE idgestante=$idgestante AND idresponsable=$idresponsable AND fecha='$fecha' and estado=1 ORDER BY fecha DESC";
        return DB::select($sql);
    }

    public static function dias_pasado($fecha_inicial, $fecha_final)
    {
        $dias = (strtotime($fecha_inicial) - strtotime($fecha_final))/86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }

    public static function convertToUft_8( $str ) {
        try{
            $texto = iconv( "Windows-1252", "UTF-8//IGNORE", $str );
            //if($texto )
            return $texto;
        }catch (Exception $ex){
            //dd($str);
        }

    }

}