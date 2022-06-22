<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Privilegios;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use App\Models\History;
use DateTime;
use stdClass;
use Illuminate\Support\Facades\Log;
use App\Models\RolMenu;
use App\Models\Menu;

class RolController extends Controller
{
    //
    public function getRoles(Request $request){
        $data = DB::select('SELECT * from rols where rols.vigencia_id = 1');
        return $data;
    }

    public function mantenedor_perfil(){
        $rols = DB::select("SELECT  rols.id, rols.name, count(users.id) as total FROM rols inner join privilegios on rols.privilegios_id = privilegios.id
        left join users on rols.id = users.rol_id GROUP BY rols.id, rols.name");
        return view('mantenedores/mantenedor_perfil',
        ['roles' 				=> $rols]);
    }

    public function getPrivilegiosRoles(){

        try{ 
        
            $privilegios = DB::select("SELECT  rols.id, rols.name, privilegios.leer, privilegios.escribir, 
            privilegios.eliminar, rols.vigencia_id FROM rols inner join privilegios on rols.privilegios_id = privilegios.id");
            return response()->json([
                'data' => $privilegios,
            ]);
            
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }    
        

    }

    public  function addRole(Request $request){
        try {
			
			DB::beginTransaction();
            $fecha = new DateTime();
            if($request->name != null){
                $role = new Rol();
                $role->name = $request->name;
                $role->vigencia_id = 1;
                $role->privilegios_id = 1;
                $role->save();

                $data = new stdClass();
                $data->id_usuario = Auth::user()->id;
                $data->acción = 'Crear';
                $data->descripcion = 'Se ha creado perfil ' . $request->name ;      
                $data->timestamps = $fecha->getTimestamp();
                
                History::createHistory($data);
            }
            if($request->tabla !=null){
                foreach ( $request->tabla as $p) {

                    $findPrivilegios = Privilegios::where('escribir', "=", $p['escribir'])->where('leer', "=", $p['leer'])->where('eliminar', "=", $p['eliminar'])->get()->toArray();
    
                    if(count($findPrivilegios) > 0) {
                        $findRole = Rol::find($p['id']);
    
                        if($findRole->privilegios_id != $findPrivilegios[0]['id'] || $findRole->vigencia_id != $p['vigencia_id']){
                          
                            $findRole->privilegios_id = $findPrivilegios[0]['id'];
                            $findRole->vigencia_id = $p['vigencia_id'];
                            $findRole->save();
                            $data = new stdClass();
                            $data->id_usuario = Auth::user()->id;
                            $data->acción = 'Editar';
                            $data->descripcion = 'Se ha editado perfil ' . $findRole->name ;      
                            $data->timestamps = $fecha->getTimestamp();
                            
                            History::createHistory($data);
                        }
    
                    }else{
                        $privilegios = new Privilegios();
                        $privilegios->leer = $p['leer'];
                        $privilegios->escribir = $p['escribir'];
                        $privilegios->eliminar = $p['eliminar'];
                        $privilegios->save();
                        $privilegios->timestamps = $fecha->getTimestamp();

                        $findRole = Rol::find($p['id']);
                        $findRole->privilegios_id = $privilegios->id;
                        $findRole->timestamps = $fecha->getTimestamp();

                        $findRole->save();
                  
                    }
    
    
                }
            }


            
            $mensaje = "Operacion realizada con exito!";

            DB::commit();

         
            $roles = new RolMenu();
            $roles->id_role = DB::select('select top(1) rols.id as id from rols order by id desc')[0]->id;
            $menu = Menu::where('name', '=', 'Dashboard')->get();
            $roles->id_menu =  $menu[0]['id'];
            $roles->timestamps = $fecha->getTimestamp();
            $roles->save(); 

            DB::commit();


            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  
    }

    public function getPrivilegios(){
        $rols = DB::select("SELECT  rols.id, rols.name, count(users.id) as total FROM rols inner join privilegios on rols.privilegios_id = privilegios.id
        left join users on rols.id = users.rol_id GROUP BY rols.id, rols.name");
        return response()->json([
            'data' => $rols,
        ]);
    }

    public function eliminarRol(Request $request){
        try {
			
			DB::beginTransaction();
            $fecha = new DateTime();

            $buscarUsuarios = User::where('rol_id', $request->id)->get();
            if(count($buscarUsuarios) > 0){
                return response()->json(array('estado' => '0', 'mensaje' => 'No es posible eliminar rol debido a que existen usuarios asignados con el rol a eliminar.'), 200);
            }
    
            $buscarRol = Rol::find($request->id);
            $buscarRol->delete();
    
            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Eliminar';
            $data->descripcion = 'Se ha eliminado el rol ' . $request->id;      
            $data->timestamps = $fecha->getTimestamp();
            
            History::createHistory($data);

            
            DB::commit();
    
            $mensaje = "Rol eliminado con exito!";
    
            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);

        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  

    }
}
