<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;

use App\Exports\informeTransparenciaHonorariaExcel;
use App\Exports\informeDipresExcel;
use App\Exports\informeHorasExtrasExcel;
use App\Models\SubTablasGenerales;

use App\Models\History;
use DateTime;
use stdClass;



class SIS_GestionController extends Controller
{
    public function reporteInfomeDipres_2022(){
        return view('reportes/informe_dipres');
    }
    public function informeDipres_2022(Request $request){
        $año = $request->agno;
        $mes = $request->mes;
        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Ver';
        $data->descripcion = 'Ha visualizado el siguiente informe: Informe Dipres: mes: ' .$request->mes . ', año: ' . $request->agno;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);


        $datos = DB::select('SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_DIPRES_2022] @ANO = '.$año.',@MES = ' . $mes);
        
        return response()->json([
            'data' => $datos,
        ]);
    }
    public function informe_transparencia_honorarios(Request $request){
        $año = $request->agno;
        $mes = $request->mes;
        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Ver';
        $data->descripcion = 'Ha visualizado el siguiente informe: Informe Transparencia Honoraria: mes: ' .$request->mes . ', año: ' . $request->agno;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);

        $datos = DB::select('SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_TRANSPARENCIA_HONORARIOS] @ANO = '.$año.',@MES = ' . $mes);
        
        return response()->json([
            'data' => $datos,
        ]);
    }

    public function reporteInformeTransparenciaHonorarios(){
        return view('reportes/informe_trasparencia_honoraria');
    }


    public function informe_hora_extra(Request $request){
        return view('reportes/informe_hora_extras');
    }

    public function getMes(){
        $data = SubTablasGenerales::where('cod_tabla', "=", 1)->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDireccion(){
        $data = SubTablasGenerales::where('cod_tabla', "=", 2)->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function getInfomeHoraExtra(Request $request){
        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Ver';
        $data->descripcion = 'Ha visualizado el siguiente informe: Informe Horas Extras: mes: ' .$request->mes . ', año: ' . $request->agno . ", direccion: " . $request->direccion . ", rut: " . $request->rut;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);

        $agno = $request->agno;
        $mes = $request->mes;
        $direccion = $request->direccion;
        $rut = $request->run;
        $datos = '';
        if($rut == ''){
            $datos = DB::select("SET NOCOUNT ON  USE [SIS_Gestion]  EXEC [dbo].[SP_GES_INFORME_HORAS_EXTRAS] 
            @ANO = ".$agno.",
		    @MES = N'".$mes."',
		    @DIRECCION = N'".$direccion."'");
        }else{
            $datos = DB::select("SET NOCOUNT ON  
            USE [SIS_Gestion]  EXEC	[dbo].[SP_GES_INFORME_HORAS_EXTRAS]
            @ANO = ".$agno.",
            @MES = N'".$mes."',
            @DIRECCION = N'".$direccion."',
            @RUT = N'".$rut."'");

        }
        
        return response()->json([
            'data' => $datos,
        ]);
    }

    public function excelInformeHorasExtras(Request $request){
        $nombre_archivo = 'InformeHorasExtras';

        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Descargar';
        $data->descripcion = 'Ha descargar el siguiente informe: Informe Horas Extras: mes: ' .$request->mes . ', año: ' . $request->agno . ", direccion: " . $request->direccion . ", rut: " . $request->rut;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);
        $request->direccion = str_replace(",",";",$request->direccion);
        $request->mes = str_replace(",",";",$request->mes);
        return \Excel::download(new informeHorasExtrasExcel($request->agno,$request->mes, $request->direccion, $request->rut), $nombre_archivo.date('d-m-Y').".xlsx");
    }

    public function excelInformeTransparenciaHonorarios(Request $request){
        $nombre_archivo = 'InformeTransparenciaHonoraria';
        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Descargar';
        $data->descripcion = 'Ha descargar el siguiente informe: Informe Transpariencia Honoraria: mes: ' .$request->mes . ', año: ' . $request->agno;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);

        return \Excel::download(new informeTransparenciaHonorariaExcel($request->agno,$request->mes), $nombre_archivo.date('d-m-Y').".xlsx");

    }
    
    public function excelInformeDipres(Request $request){
        $nombre_archivo = 'InformeDipres';
        $fecha = new DateTime();
        $data = new stdClass();
        $data->id_usuario = Auth::user()->id;
        $data->acción = 'Descargar';
        $data->descripcion = 'Ha descargar el siguiente informe: Informe Dipres: mes: ' .$request->mes . ', año: ' . $request->agno;      
        $data->timestamps = $fecha->getTimestamp();
        History::createHistory($data);

        return \Excel::download(new informeDipresExcel($request->agno,$request->mes), $nombre_archivo.date('d-m-Y').".xlsx");
    }
}
