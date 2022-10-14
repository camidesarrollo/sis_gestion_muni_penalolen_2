<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\Privilegios;
use App\Models\Rol;
use App\Models\History;
use App\Models\User;
use DateTime;
use stdClass;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(count(User::where('email', '=', $attributes['email'])->where('vigencia_id', '=', 1)->get()) > 0){
            
            $rol = User::select('rol_id')->where('email', '=', $attributes['email'])->get();

            if(Rol::where('id', $rol[0]['rol_id'])->where('vigencia_id', 1)->count() == 0){
                return back()->withErrors(['error'=>'Usuario sin rol asociado.']);
            }


            if(Auth::attempt($attributes))
            {
                
        
     
                $fecha = new DateTime();
                $data = new stdClass();
                $data->id_usuario = Auth::user()->id;

                $data->acción = 'Iniciar Sesión';
                $data->descripcion = 'El usuario ' . Auth::user()->run . '-'. Auth::user()->dv .' ha iniciado sesion';      
                $data->timestamps = $fecha->getTimestamp();
                History::createHistory($data);

                $menu = Menu::select('menus.*')->join('rols_menu', 'menus.id', '=', 'rols_menu.id_menu')
                ->where('rols_menu.id_role', '=', Auth::user()->rol_id)
                ->where('menus.vigencia_id', '=', 1)
                ->orderBy('orden', 'ASC')->get()->toArray();

                $treeMenu = new Menu();
                $treeMenu = $treeMenu->MenuTreeRol($menu);
                $rol = Rol::where('id', Auth::user()->rol_id)->get();
                $privilegios = Privilegios::where('id', '=', $rol[0]->privilegios_id)->get();
                session()->regenerate();
                session()->put("menu",$treeMenu);
                session()->put("privilegios", $privilegios[0]);
                // return redirect('dashboard')->with(['success'=>'You are logged in.']);
                return redirect('dashboard');

            }else{

                return back()->withErrors(['email'=>'El correo electrónico o la contraseña no son válidos.']);
            }
        }else{
            return back()->withErrors(['error'=>'El usuario no autorizado.']);
        }
        
    }
    
    public function destroy()
    {

        Auth::logout();

        // return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
        return redirect('/login');
    }
}
