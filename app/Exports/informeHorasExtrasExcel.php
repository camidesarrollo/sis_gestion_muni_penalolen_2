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
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;


class informeHorasExtrasExcel implements FromCollection, WithDrawings,  WithEvents, WithCustomStartCell, WithHeadings, WithMultipleSheets, WithTitle,  WithColumnWidths  {

    public function __construct($agno, $mes, $direccion,$rut ) {
        $this->agno = $agno;
        $this->mes = $mes;
        $this->direccion = $direccion;
        $this->rut = $rut;
    }

    public function registerEvents(): array { 
        return [AfterSheet::class => function (AfterSheet $event) {

                // estilos
                $estilos_titulos_tabla_contenido = ['font' => array('name' => 'Calibri', 'size' => 11, 'bold' => false)];
                $estilos_titulo_reporte = ['color' => ['argb' => '000000'], 'font' => array('name' => 'Calibri', 'size' => 20, 'bold' => false, 'color' => ['argb' => '000000'],), 'blackgroud-color' => ['argb' => 'fff'], ];
                $estilos_linea_totales = ['font' => array('name' => 'Calibri', 'size' => 12, 'bold' => true)];

                // titulo de tabla contenido
                $event->sheet->getDelegate()->getStyle('A11:R11')->applyFromArray($estilos_titulos_tabla_contenido);
                $event->sheet->getDelegate()->setAutoFilter('A11:'.$event->sheet->getDelegate()->getHighestColumn().'11');
                $event->sheet->getDelegate()->getStyle('H2:H10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('J2:J10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('L2:L10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('O2:O10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $event->sheet->getDelegate()->getStyle('P2:P10000')->getNumberFormat()->setFormatCode('$#,##0;[red]$(-#,##0)');
                $nombre_reporte = "Informe Horas Extras";

                
                // titulo del reporte
                
                $event->sheet->setCellValue('A6', $nombre_reporte)->getStyle('A6')->applyFromArray($estilos_titulo_reporte);

                // fecha de ejecución de reporte
                $event->sheet->setCellValue('C2','Fecha Reporte: ');
                $event->sheet->setCellValue('C3', date('d-m-Y'));
            }, 
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 33,
            'B' => 15,  
            'C' => 45,
            'D' => 26,  
            'E' =>  13,  
            'F' => 22,  
            'G' => 9,       
            'H' => 16,
            'I' => 18,          
            'J' => 22,
            'K' => 16,
            'L' => 22,
            'M' => 21,  
            'N' => 9,
            'O' => 9,
            'P' => 22,
            'Q' => 6,
            'R' => 6,            
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
        if($this->rut == ''){
            $datos = DB::select("SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_HORAS_EXTRAS] 
            @ANO = ".$this->agno.",
		    @MES = N'".$this->mes."',
		    @DIRECCION = N'".$this->direccion."'");
        }else{
            $datos = DB::select("SET NOCOUNT ON  
            USE [SIS_Gestion]  EXEC	[dbo].[SP_GES_INFORME_HORAS_EXTRAS]
            @ANO = ".$this->agno.",
            @MES = N'".$this->mes."',
            @DIRECCION = N'".$this->direccion."',
            @RUT = N'".$this->rut."'");

        }

        return collect($datos);
    }

        // se inicia en la fila 8, pues de la fila 1 a a 7 va el logo y titulo del reporte
    public function startCell(): string { 
        return 'A11';
    } 

     // nombre de los titulos de la tabla de contenido
     public function headings(): array {
        return  $titulos_excel = [
        'ID Funcionario'
        ,'Rut'				
        ,'Nombre'		
        ,'Calidad Contractual'
        ,'Direción'	
        ,'Estamento'		
        ,'Grado'		
        ,'Costo Grado'
        ,'N° de horas en 25'
        ,'Monto de horas en 25'
        ,'N° de horas en 50'
        ,'Monto de horas en 50'
        ,'Diferencia Hrs extras'
        ,'Turno'
        ,'Total'
        ,'Total costo del grado'
        ,'Año'
        ,'Mes'
        ];
     }

     public function sheets(): array{

        $sheets[] =  new informeHorasExtrasExcel($this->agno, $this->mes,  $this->direccion,  $this->rut);
        return $sheets;
    }

    public function title(): string{
        $titulo = 'Informe Transparencia Honoraria';
        return $titulo;
    }
}