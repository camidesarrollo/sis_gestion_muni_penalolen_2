<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function getHistory(Request $request){
        try {
                
            
            $history = DB::select('select top (10) *  from histories where id_usuario = '. $request->id_usuario .'order by id desc');

            return response()->json([
                'data' => $history,
            ]);

        
        } catch(\Exception $e) {
           
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }    
    }
}
