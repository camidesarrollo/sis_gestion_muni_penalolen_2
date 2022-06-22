<?php
namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Style; 
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class informeDipresExcel 
extends  DefaultValueBinder  
implements FromCollection, WithEvents, WithCustomStartCell, WithHeadings, WithMultipleSheets, WithTitle, WithColumnWidths 
,WithCustomValueBinder 
{

    public function __construct($agno, $mes) {
        $this->agno = $agno;
        $this->mes = $mes;
    }

    public function registerEvents(): array { 
        return [AfterSheet::class => function (AfterSheet $event) {

                // estilos
                $estilos_titulos_tabla_contenido = ['font' => array('name' => 'Calibri', 'size' => 11, 'bold' => false)];
               

                
                // $event->sheet->getDelegate()->getStyle('A1:AI1')->applyFromArray($estilos_titulos_tabla_contenido)->getAlignment()->setWrapText(false)->setHorizontal('center');
                
                $event->sheet->getDelegate()->getStyle('A1:AI1')->applyFromArray($estilos_titulos_tabla_contenido);

                $event->sheet->getDelegate()->getStyle('A2:D10000')->getNumberFormat()->setFormatCode('@');
                $event->sheet->getDelegate()->getStyle('Y2:Y10000')->getNumberFormat()->setFormatCode('dd-mm-yy;@');
                $event->sheet->getDelegate()->getStyle('Y2:Y10000')->getAlignment()->setWrapText(false)->setHorizontal('right');
                $event->sheet->getDelegate()->setAutoFilter('A1:'.$event->sheet->getDelegate()->getHighestColumn().'1');

            },  
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 11,
            'B' => 11,  
            'C' => 13,
            'D' => 11,  
            'E' =>  11,  
            'F' => 24,  
            'G' => 11,       
            'H' => 24,
            'I' => 11,          
            'J' => 11,
            'K' => 11,
            'L' => 5,
            'M' => 4,  
            'N' => 17,
            'O' => 14,
            'P' => 33,
            'Q' => 33,
            'R' => 42,
            'S' => 5,
            'T' => 15,
            'U' => 10,
            'V' => 28,
            'W' => 15,
            'X' => 32,
            'Y' => 32,
            'Z' => 17,  
            'AA' => 25,
            'AB' => 27,
            'AC' => 29, 
            'AD' => 38, 
            'AE' => 11,
            'AF' => 11,
            'AG' => 11,    
            'AH' => 11,  
            'AI' => 11,                    
        ];
    }

    // rescata la información que pobla el reporte
    public function collection() {
        $año = $this->agno;
        $mes =  $this->mes;
        $datos = DB::select('SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_DIPRES_2022] @ANO = '.$año.',@MES = ' . $mes);
        
        foreach($datos as $data){
            if($data->Fecha_Ingreso_Institucion){
                $input = $data->Fecha_Ingreso_Institucion;
                $input = str_replace('/', '-',$input);
                $data->Fecha_Ingreso_Institucion = date('d-m-y', strtotime($input));
            }

        }

        return collect($datos);
    }

        // se inicia en la fila 8, pues de la fila 1 a a 7 va el logo y titulo del reporte
    public function startCell(): string { 
        return 'A1';
    } 

     // nombre de los titulos de la tabla de contenido
     public function headings(): array {
        return  $titulos_excel = [
            'Partida_Ley',	
            'Capítulo_Ley',	
            'Programa_Ley',	
            'Area_Transaccional', 	
            'Nombre de Institución - pagadora',	
            'Rut de institución - pagadora',	
            'DV de institución -  pagadora',	
            'Nombre de Institución donde trabaja',	
            'Rut de Institución donde trabaja',	
            'DV de Institución donde trabaja',	
            'Región',	
            'Año',	
            'Mes',	
            'Rut Trabajador', 
            'DV Trabajador',	
            'Apellido paterno',	
            'Apellido materno',	
            'Nombres',	
            'Sexo',	
            'Calidad jurídica',	
            'Estamento',	
            'Grado o nivel de remuneraciones',	
            'Jornada_contrato',	
            'Cargo',	
            'Fecha de ingreso a la institución',	
            'Unidad monetaria',	
            'Remuneración bruta total',	
            'Remuneración líquida legal',	
            'Remuneración líquida efectiva',	
            'Monto pagado por trabajos extraordinarios (Horas extraordinarias)',	
            'Nº horas extraordinarias pagadas',	
            'Aportes patronales',	
            'Remuneración percibida área geográfica de trabajo',	
            'Viáticos',	
            'Confidencial',

        ];
     }

     public function sheets(): array{
        $sheets[] =  new informeDipresExcel($this->agno,$this->mes);
        return $sheets;
    }

    public function title(): string{
        $titulo = 'Informe Dipres';
        return $titulo;
    }
}

