<?php
namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class informeTransparenciaHonorariaExcel implements FromCollection, WithDrawings,  WithEvents, WithCustomStartCell, WithHeadings, WithMultipleSheets, WithTitle, ShouldAutoSize {

    public function __construct($agno, $mes) {
        $this->agno = $agno;
        $this->mes = $mes;   
    }

    public function registerEvents(): array { 
        return [AfterSheet::class => function (AfterSheet $event) {

                // estilos
                $estilos_titulos_tabla_contenido = ['font' => array('name' => 'Calibri', 'size' => 11, 'bold' => false)];
                $estilos_titulo_reporte = ['color' => ['argb' => '000000'], 'font' => array('name' => 'Calibri', 'size' => 20, 'bold' => false, 'color' => ['argb' => '000000'],), 'blackgroud-color' => ['argb' => 'fff'], ];
                $estilos_linea_totales = ['font' => array('name' => 'Calibri', 'size' => 12, 'bold' => true)];

                // titulo de tabla contenido
                $event->sheet->getDelegate()->getStyle('A11:T11')->applyFromArray($estilos_titulos_tabla_contenido);
                $event->sheet->getDelegate()->setAutoFilter('A11:'.$event->sheet->getDelegate()->getHighestColumn().'11');
                
                $event->sheet->getDelegate()->getStyle('A12:T10000');
                $event->sheet->getDelegate()->getStyle('L2:L10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('M2:M10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('O2:O10000')->getNumberFormat()->setFormatCode('dd-mm-yy;@');
                $event->sheet->getDelegate()->getStyle('P2:P10000')->getNumberFormat()->setFormatCode('dd-mm-yy;@');
                $event->sheet->getDelegate()->getStyle('O2:O10000')->getAlignment()->setWrapText(false)->setHorizontal('right');
                $event->sheet->getDelegate()->getStyle('P2:P10000')->getAlignment()->setWrapText(false)->setHorizontal('right');

                $nombre_reporte = "Informe Transparencia Honoraria";

                
                // titulo del reporte
                
                $event->sheet->setCellValue('A6', $nombre_reporte)->getStyle('A6')->applyFromArray($estilos_titulo_reporte);

                // fecha de ejecución de reporte
                $event->sheet->setCellValue('C2','Fecha Reporte: ');
                $event->sheet->setCellValue('C3', date('d-m-YY'));
            }, 
        ];
    }




    public function drawings() {
        $drawing = new Drawing();
        $drawing->setPath(public_path('/img/muni-sis.png'));
        $drawing->setHeight(100);
        $drawing->setWidth(100);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

    // rescata la información que pobla el reporte
    public function collection() {
        $datos = DB::select('SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_TRANSPARENCIA_HONORARIOS] @ANO = '.$this->agno.',@MES = ' . $this->mes);
        
        
        foreach($datos as $data){
            if($data->FECHA_INICIO){
                $input = explode(" ", $data->FECHA_INICIO);
                $data->FECHA_INICIO = date('d-m-Y', strtotime($input[0]));
            }

            if($data->FECHA_TERMINO){
                $input = explode(" ", $data->FECHA_TERMINO);
                $data->FECHA_TERMINO = date('d-m-Y', strtotime($input[0]));
            }

        }

        return collect($datos);
    }

        // se inicia en la fila 8, pues de la fila 1 a a 7 va el logo y titulo del reporte
    public function startCell(): string { 
        return 'A11';
    } 

     // nombre de los titulos de la tabla de contenido
     public function headings(): array {
        return  $titulos_excel = ['Tipo Personal', 
        'Año',
        'Mes',
        'Apellido Paterno',
        'Apellido Materno', 
        'Nombres', 
        'Grados US', 
        'Descripción Funcional',  
        'Calificación Profecional', 
        'Region',
        'Unidad Monetaria',
        'Honorario total bruto',
        'Remuneracion liquida mensual',
        'Pago mensual', 
        'Fecha inicio',
        'Fecha termino',
        'Observaciones',
        'Declaración Patrimonial',
        'Declaración Intereses',
        'Viaticos'

        ];
     }

     public function sheets(): array{

        $sheets[] =  new informeTransparenciaHonorariaExcel($this->agno, $this->mes);
        return $sheets;
    }

    public function title(): string{
        $titulo = 'Informe Transparencia Honoraria';
        return $titulo;
    }
}