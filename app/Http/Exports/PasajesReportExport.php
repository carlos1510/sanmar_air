<?php

namespace App\Http\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Http\Services\FligthServices;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PasajesReportExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    protected $service;
    protected $estado;
    protected $fecha_inicio;
    protected $fecha_final;
    protected $tipo_servicio;
    protected $idruta_viaje_precio;
    protected $dni;

    public function __construct($estado, $fecha_inicio, $fecha_final, $dni, $tipo_servicio, $idruta_viaje_precio)
    {
        $this->service = new FligthServices();
        $this->estado = $estado;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->dni = $dni;
        $this->tipo_servicio = $tipo_servicio;
        $this->idruta_viaje_precio = $idruta_viaje_precio;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return ['ESTADO','TIPO DE SERVICIO','DNI','PASAJERO','TELEFONO','EDAD','TIPO DE PASAJERO','PAC/ACOMP.','ORIGEN - DESTINO','FECHA DE CITA','FECHA DE VIAJE'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {}
        ];
    }

    public function columnFormats(): array
    {
        return [
            /*'C' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT*/
        ];
    }

    public function collection(){
        $dato['estado'] = isset($this->estado)?$this->estado:null;
        $dato['fecha_inicio'] = isset($this->fecha_inicio)?$this->fecha_inicio:null;
        $dato['fecha_final'] = isset($this->fecha_final)?$this->fecha_final:null;
        $dato['numero_documento'] = isset($this->dni)?$this->dni:null;
        $dato['tipo_servicio'] = isset($this->tipo_servicio)?$this->tipo_servicio:null;
        $dato['idruta_viaje_precio'] = isset($this->idruta_viaje_precio)?$this->idruta_viaje_precio:null;
        $params = (array)$dato;

        $result = $this->service->listarPasajesReservados($params);
        $data = array();
        foreach ($result as $item){
            $data[] = array('nom_estado' => $item->nom_estado, 'tipo_servicio' => $item->tipo_servicio, 'dni' => $item->numero_documento, 'pasajero' => $item->apellido_paterno.' '.$item->apellido_materno.' '.$item->nombres, 'telefono' => $item->telefono,
                'edad' => $item->edad, 'tipo_pasajero' => $item->tipo_pasajero, 'pac_acomp' => $item->tipo_paciente, 'origen_destino' => $item->nomb_origen_destino,
                'fecha_cita' => $item->fecha_cita, 'fecha_viaje' => $item->fecha_viaje);
        }

        $collection = collect($data);
        return $collection;
    }

}
