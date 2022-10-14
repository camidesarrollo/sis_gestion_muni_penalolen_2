<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\NewUser;
use App\Models\History;
use DateTime;
use stdClass;


class InfoUserController extends Controller
{
    
    public function findUser(Request $request){

        try {
            
            if($request->id_usuario == null || $request->id_usuario == ''){
                return response()->json(array('estado' => '0', 'mensaje' => 'El usuario no ha sido encontrado, por favor intentelo nuevamente'), 200);
            }

            $data = User::select('users.id as user_id','users.run', 'users.dv', 
            'users.name as nombre', 'users.ap_paterno', 'users.ap_materno', 
            'users.email', 'users.phone','rols.id as rol_id','rols.name as rol_name', 'vigencia.name as vige_name', 'vigencia.id as vigencia_id',
            'privilegios.leer', 'privilegios.escribir', 'privilegios.eliminar')
            ->where('users.id', $request->id_usuario)
            ->join('rols', 'users.rol_id', '=', 'rols.id')
            ->join('vigencia', 'users.vigencia_id', '=', 'vigencia.id')
            ->join('privilegios', 'privilegios.id', '=', 'rols.privilegios_id')
            ->get();


            $dataHistoryDescaga = History::where('id_usuario', '=', $request->id_usuario)->where('accion', '=', 'Descargar')->count();
            $dataHistoryVer = History::where('id_usuario', '=', $request->id_usuario)->where('accion', '=', 'Ver')->count();  
            
            return response()->json([
                'data' => $data,
                'dataHistoryDescaga' => $dataHistoryDescaga,
                'dataHistoryVer' => $dataHistoryVer
            ]);

        } catch(\Exception $e) {
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }    
    }

    public function getAll(){

        try{ 
            $getAll = User::select('users.id as user_id','users.run', 'users.dv', 
            'users.name as nombre', 'users.ap_paterno', 'users.ap_materno', 
            'users.email', 'users.phone','rols.name as rol_name', 'vigencia.name as vige_name')
            ->join('rols', 'users.rol_id', '=', 'rols.id')
            ->join('vigencia', 'users.vigencia_id', '=', 'vigencia.id')
            ->get();

            return response()->json([
                'data' => $getAll,
            ]);
        } catch(\Exception $e) {

            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }    
        
    }

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                
            }
            
        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }
        
        
        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attribute['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes["about_me"],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }

    public function mantenedor_usuario(){
        return view('mantenedores/mantenedor_usuario');
    }

    public function delete_user(Request $request){
        try {

			DB::beginTransaction();

            if($request->id_usuario == null || $request->id_usuario == ''){
                return response()->json(array('estado' => '0', 'mensaje' => 'El usuario no ha sido encontrado, por favor intentelo nuevamente'), 200);
            }

            $history = History::where('id_usuario', $request->id_usuario);
            if(count($history->get()) > 0){
                $history->delete();
            }


            $usuario =  User::where('id', $request->id_usuario);
            if(count($usuario->get()) > 0){
                $usuario->delete();
            }else{
                return response()->json(array('estado' => '1', 'mensaje' => 'Error al eliminar, usuario no existe!'), 200);
            }
        

            $mensaje = "Usuario eliminado con exito!";
            $fecha = new DateTime();
            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Eliminar';
            $data->descripcion = 'Se ha eliminado el usuario ' . $request->run . '-'. $request->dv ;      
            $data->timestamps = $fecha->getTimestamp();
            
            History::createHistory($data);


            DB::commit();

            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  

    }

    public function save_user(Request $request){
        try {
            $fecha = new DateTime();

			DB::beginTransaction();

        if($request->name == " " || $request->email == " "|| $request->ap_paterno == " "|| $request->ap_paterno == " "|| $request->ap_materno == " "|| $request->run == " "|| $request->dv == " " || $request->phone == " " || $request->vigencia_id == " "){
            $mensaje = "Error: Existen datos no ingresados, intentelo nuevamente!";

            return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
        }
        $findUser = User::where('email', '=', $request->email)->get();
        if(count($findUser) > 0){
            $mensaje = "Error: El correo electronico ya esta ingresado, por favor ingrese otro!";

            return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
        }
        $cadena = $this->eliminar_acentos($request->ap_paterno);
	    $clave1 = substr($cadena, 0, 3);
	    $clave2 = substr($request->run, 0, 4);
	    $clave = ucfirst(strtolower(strrev($clave1))).'.'.$clave2;

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($clave);
        $usuario->ap_paterno = $request->ap_paterno;
        $usuario->ap_materno = $request->ap_materno;
        $usuario->run = $request->run;
        $usuario->dv = $request->dv;
        $usuario->phone = $request->phone;
        $usuario->rol_id = $request->rol_id;
        
        $usuario->vigencia_id = $request->vigencia_id;
        $usuario->timestamps = $fecha->getTimestamp();

        $usuario->save();

        $findRole = Rol::find($request->rol_id)->name;

        $this->correoCrearUsuario( $request->email, $clave, $findRole );

        if(!$usuario){
            DB::rollback();
            $mensaje = "Hubo un error al momento de guardar el usuario!.";

            return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
         }
  

         $mensaje = "Usuario guardado con exito!";
         $fecha = new DateTime();
         $data = new stdClass();
         $data->id_usuario = Auth::user()->id;
         $data->acción = 'Crear';
         $data->descripcion = 'Se ha creado usuario ' . $request->run . '-'. $request->dv ;      
         $data->timestamps = $fecha->getTimestamp();
         
         History::createHistory($data);

         DB::commit();

         return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);



        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  
    }

    public function update_user(Request $request){
        try {

            if($request->name == " " || $request->email == " "|| $request->ap_paterno == " "|| $request->ap_paterno == " "|| $request->ap_materno == " "|| $request->run == " "|| $request->dv == " " || $request->phone == " " || $request->vigencia_id == " "){
                $mensaje = "Error: Existen datos no ingresados, intentelo nuevamente!";
    
                return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
            }

			
			DB::beginTransaction();
            $fecha = new DateTime();

            $usuario =  User::find($request->id_usuario);
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->ap_paterno = $request->ap_paterno;
            $usuario->ap_materno = $request->ap_materno;
            $usuario->phone = $request->phone;
            $usuario->rol_id = $request->rol_id;
            $usuario->vigencia_id = $request->vigencia_id;
            $usuario->timestamps = $fecha->getTimestamp();

            $usuario->save();

           
            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Editar';
            $data->descripcion = 'Se ha editado el usuario '. $usuario->run . '-' . $usuario->dv;     
            $data->timestamps = $fecha->getTimestamp();
            
            History::createHistory($data);

            if(!$usuario){
                DB::rollback();
                $mensaje = "Hubo un error al momento de guardar el usuario!.";

                return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
            }

            $mensaje = "Usuario editado con exito!";

            
            
            DB::commit();

            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);

        } catch(\Exception $e) {
			DB::rollback();
			Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
		}  
    }

    function changeContrasena(Request $request){
        try {


            if($request->id_usuario == null || $request->id_usuario == '' || $request->cont == null || $request->cont == ''){
                return response()->json(array('estado' => '0', 'mensaje' => 'Error: Existen datos no ingresados, intentelo nuevamente!'), 200);
            }

			DB::beginTransaction();
            
                
            $fecha = new DateTime();

            $user = User::find($request->id_usuario);

            
            $user->password = Hash::make($request->cont);
            $user->timestamps = $fecha->getTimestamp();
            $user->save();


            $mensaje = "Contraseña acutalizada con exito!";

            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Editar';
            $data->descripcion = 'El usuario '.Auth::user()->id.' ha realizado cambio de clave';      
            $data->timestamps = $fecha->getTimestamp();
            
            History::createHistory($data);

            DB::commit();
            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);

        } catch(\Exception $e) {
			DB::rollback();
			Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
		}    
       
    }

    function correoCrearUsuario($email, $clave,$perfil){
        try {

            Mail::send(new NewUser($email, $clave, $perfil));

        } catch(\Exception $e) {
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }    
    }

    function eliminar_acentos($cadena){
	    
		//Reemplazamos la A y a
	    $cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
	        $cadena
	        );
	    
		//Reemplazamos la E y e
	    $cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	        $cadena );
	    
		//Reemplazamos la I y i
	    $cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	        $cadena );
	    
		//Reemplazamos la O y o
	    $cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	        $cadena );
	    
		//Reemplazamos la U y u
	    $cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	        $cadena );
	    
		//Reemplazamos la N, n, C y c
	    $cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
	        $cadena
	        );
	    
	    return $cadena;
	}
}
