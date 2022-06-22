<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Menu;
use App\Models\UserMenu;
use App\Models\RolMenu;

use App\Models\History;
use DateTime;
use stdClass;


class MenuController extends Controller
{
    //

    public function getMenuUsuario(Request $request)
    {
        try {

        return $getMenu = Menu::select()
        ->join('user_menu', 'menus.id', '=', 'user_menu.id_menu')
        ->where('user_menu.id_usuario' , "=", Auth::user()->id)
        ->get();

        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  
    }

    public function getMenu(){
        try {

            $data = Menu::select("menus.id","menus.name", "menus.path", "menus.icon", "menus.padre", 'vigencia.name as nombre_vigencia', 'menus.orden')
            ->join('vigencia', 'menus.vigencia_id', '=', 'vigencia.id')->get();
            
            

            foreach ($data as $menu) {

                $dataRole = DB::select('SET NOCOUNT ON  USE SIS_Global  select menus.id, rols.id as rol_id, rols.name from menus join rols_menu on menus.id = rols_menu.id_menu join rols on rols.id = rols_menu.id_role where menus.id = '. $menu->id);
                // print_r($dataRole);
                // die();
                $menu->role = $dataRole;
            }
            return response()->json([
                'data' => $data,
            ]);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        } 
    }

    public function mantenedor_menu(){
        return view('mantenedores/mantenedor_menu');
    }

    public function delete_menu(Request $request){
        try {
            $fecha = new DateTime();
			DB::beginTransaction();
            $findmeun = Menu::find($request->id);



            $dataOrden = DB::select('SELECT  * FROM menus where orden > '.$findmeun['orden'].' ORDER BY orden Asc');
            for($i = 0; $i <count($dataOrden); $i++){
                if($dataOrden[$i]->orden >= $request->orden){
                    
                    $update = Menu::find($dataOrden[$i]->id);
                    $update['orden'] = $update['orden']-1;
                    $update->timestamps = $fecha->getTimestamp();
                    $update->save();
                    
                }
            }

            $menuUser = RolMenu::where('id_menu', $request->id);
            $menuUser->delete();

            $menu = Menu::find($request->id);
            $menu->delete();


            $mensaje = "Menu eliminado con exito!";
      
            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Eliminar';
            $data->descripcion = 'Se ha eliminado el menu ' . $menu->name;      
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
    
    public function findMenu(Request $request){
        try {
			
            $data = Menu::where('id', '=', $request->id)->get();

            $dataRole = DB::select('SET NOCOUNT ON  USE SIS_Global  select rols.id as rol_id from menus join rols_menu on menus.id = rols_menu.id_menu join rols on rols.id = rols_menu.id_role where menus.id = '. $request->id);

            $data[0]->roles = $dataRole;

        

            return response()->json(array('estado' => '1', 'data' => $data[0]), 200);

        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => 'Ha ocurrido un error al momento de obtener el menu solicitado.'), 200);
        }  
    }

    public function obtenerOrden(Request $request){
        try{
            if($request->id == 0){
                $data = DB::select('SELECT orden FROM menus where padre = 0 ORDER BY orden ASC');

                $masCantidad = $data[count($data) - 1]->orden +1;
                $obj1 = new \stdClass;
                $obj1->orden = $masCantidad ;
            
                $data[count($data)] = $obj1;

            }else{
                if($request->menu_padre != ""){
                    $data = DB::select('SELECT orden FROM menus where padre = '.$request->menu_padre.' ORDER BY orden ASC');
                    if(count($data) == 0){
                        $data = DB::select('SELECT top(1) orden+1 as orden FROM menus where padre != 0 ORDER BY orden ASC');
                    }else{
                        if($request->editar != 'si'){
                            $masCantidad = $data[count($data) - 1]->orden +1;
                            $obj1 = new \stdClass;
                            $obj1->orden = $masCantidad ;
                        
                            $data[count($data)] = $obj1;
                        }
                    }
                }else{
                    $data = DB::select('SELECT orden FROM menus where padre != 0 ORDER BY orden ASC');
                }
                
            }
           




            return response()->json(array('estado' => '1', 'data' => $data), 200);
        }catch(Exception $e){
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }


       
    }

    public  function save_menu(Request $request){
        try {
            $fecha = new DateTime();
			DB::beginTransaction();
            $findmenu =  Menu::where('name', '=', $request->name)->get();
            
            if(count($findmenu) > 0){
                
            $mensaje = "Menu ya se encuentra registrador, por favor ingrese un nuevo menu!";

            return response()->json(array('estado' => '0', 'mensaje' => $mensaje), 200);
            
            }else{

                $dataOrden = DB::select('SELECT  * FROM menus  ORDER BY orden Asc');
                for($i = 0; $i <count($dataOrden); $i++){
                    if($dataOrden[$i]->orden >= $request->orden){
                     
                        $update = Menu::find($dataOrden[$i]->id);
                        $update['orden'] = $update['orden']+1;
                        $update->timestamps = $fecha->getTimestamp();
                        $update->save();
                    }
                }

                $menu = new Menu();
        
                $menu->name = $request->name;
                $menu->path = $request->path;
                $menu->orden = $request->orden;
                $menu->padre = $request->padre;
                $menu->icon = $request->icon;
                $menu->descripcion = $request->descripcion;
                $menu->vigencia_id = $request->vigencia_id;
                $menu->timestamps = $fecha->getTimestamp();
                $menu->save();
        
                foreach($request->role as  $role) {
                    $roles = new RolMenu();
                    $roles->id_role = $role;
                    $roles->id_menu = $menu->id;
                    $roles->timestamps = $fecha->getTimestamp();
                    $roles->save();
                }
        
                
       
                $data = new stdClass();
                $data->id_usuario = Auth::user()->id;
                $data->acción = 'Crear';
                $data->descripcion = 'Se ha creado menu ' .$request->name ;      
                $data->timestamps = $fecha->getTimestamp();
                
                History::createHistory($data);
        
        
                DB::commit();
                $mensaje = "Menu guardado con exito!";
                return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);
        
            }

        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  


    }

    public function editar_menu(Request $request){
        try {
            $fecha = new DateTime();
			
			DB::beginTransaction();
            $menu = Menu::find($request->id);
            if($menu->orden != $request->orden){
                $dataOrden = DB::select('SELECT  * FROM menus where orden >= '.$request->orden.' ORDER BY orden Asc');
                for($i = 0; $i <count($dataOrden); $i++){
                    $cantidad = $dataOrden[$i]->orden+1;
                    $update = Menu::find($dataOrden[$i]->id);
                    $update->orden = $cantidad;
                    $update->timestamps = $fecha->getTimestamp();
                    $update->save();
                }
            }

            $menu->name = $request->name;
            $menu->path = $request->path;
            $menu->orden = $request->orden;
            $menu->padre = $request->padre;
            $menu->icon = $request->icon;
            $menu->descripcion = $request->descripcion;
            $menu->vigencia_id = $request->vigencia_id;
            $menu->timestamps = $fecha->getTimestamp();
            $menu->save();

            foreach($request->role as  $role) {
                $findeMenuRole = RolMenu::where('id_role',"=" ,$role)->where('id_menu', "=", $menu->id)->get();
                if(count($findeMenuRole) == 0){
                    $roles = new RolMenu();
                    $roles->id_role = $role;
                    $roles->id_menu = $menu->id;
                    $roles->timestamps = $fecha->getTimestamp();
                    $roles->save();
                }


            }

            $fecha = new DateTime();
            $data = new stdClass();
            $data->id_usuario = Auth::user()->id;
            $data->acción = 'Editar';
            $data->descripcion = 'Se ha editado el menu ' .$request->name ;      
            $data->timestamps = $fecha->getTimestamp();
            
            History::createHistory($data);

            DB::commit();

            $mensaje = "Menu editado con exito!";

            return response()->json(array('estado' => '1', 'mensaje' => $mensaje), 200);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('error: '.$e);
            
            return response()->json(array('estado' => '0', 'mensaje' => $e), 200);
        }  
    
    }

    public function getMenuPadre(Request $request){
        $data = Menu::where('padre', '0')->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function obtenerMenuHijo(Request $request){

        $menus = Menu::select('menus.*')->join('rols_menu', 'menus.id', '=', 'rols_menu.id_menu')
        ->join('users', 'rols_menu.id_role', '=', 'users.rol_id' )
        ->where('rols_menu.id_role', '=', Auth::user()->rol_id)
        ->where('menus.vigencia_id', '=', 1)
        ->where('menus.padre', '<>', 0)
        ->orderBy('orden', 'ASC')->get()->toArray();
        for($i = 0; $i < count($menus); $i++){
            $findMenu = Menu::where('id', '=', $menus[$i]['padre'])->get();
            $path = $findMenu[0]['path'] . $menus[$i]['path'];
            $menus[$i]['path_edit'] = $path; 
            $menus[$i]['menu_name'] = $findMenu[0]['name'];
        }
        return response()->json([
            'data' => $menus,
        ]);
    }

    private  $lista_menuRole = [];
    

    public function MenuTreeRol() {
        $menu = Menu::all()->toArray();
        $this->lista_menuRole = $menu;

        $arbol = $this->builTree();

        foreach ($arbol as $key => $val) {
            if($val['padre'] != 0){
                unset($arbol[$key]);
            }
        }
        $arbol = array_values($arbol);
        return response()->json(array('estado' => '1', 'data' =>  $arbol), 200);

    }

    	// Establish tree structure
	public function builTree() {
		$treeMenus = [];
        //Recorremos el padre
        foreach ($this->getRootNode() as $menuNode) {
            //Buscamos los hijos
            
            $menuNode = $this->buildChilTree($menuNode);
            array_push($treeMenus, $menuNode);
        }
		return $treeMenus;
	}

    public function getRootNode() {

		$rootMenuLists = [];
        foreach ($this->lista_menuRole as  $menuNode ) {
            if($menuNode['padre'] == 0){
                $menuNode['tipo'] = 'Menu';
            }
            array_push($rootMenuLists, $menuNode);
        }
		return $rootMenuLists;
	}

    	// Recursion, building subtree structure
	public function buildChilTree($pNode) {
		$chilMenus = [];
     

		foreach($this->lista_menuRole as $menuNode ) {
            if($menuNode['padre'] == $pNode['id']) {
                $menuNode['path_response'] = $pNode['path'] . $menuNode['path'];
                $menuNode['tipo'] = 'SubMenu';
                array_push($chilMenus, $this->buildChilTree($menuNode));
            }
		}
        if($chilMenus){
            $pNode['subMenu'] = $chilMenus;
        }
		return $pNode;
	}


    public function MenuSideBar(){
    
        $menu = Menu::join('rols_menu', 'menus.id', '=', 'rols_menu.id_menu')->where('rols_menu.id_role', '=', Auth::user()->rol_id)->orderBy('orden', 'ASC')->get()->toArray();
  
        $this->lista_menuRole = $menu;

        $arbol = $this->builTree();


        foreach ($arbol as $key => $val) {
            if($val['padre'] != 0){
                unset($arbol[$key]);
            }
        }
        $arbol = array_values($arbol);

        $this->recursivosTreePage($arbol);

        return response()->json(array('estado' => '1', 'data' =>  $arbol), 200);
    }

    private $htmlPage = '';

    public function recursivosTreePage($data) {
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]['tipo'] == 'Menu'){
                $this->padrePage($data[$i]);
            }else{
                $this->hijoPage($data[$i]);
               
            }
          
        }
      
    }

    
    public function padrePage($data) {
   
        if(isset($data['subMenu'])){
            $this->htmlPage .=  '<li class="nav-item mt-2"><h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">'.$data['name'].'</h6></li>';

            $this->recursivosTreePage($data['subMenu']);
        }else{
            $this->htmlPage.='<li class="nav-item">';
            $href=url ($data['path']); 
            $clase =(Request::is($data['path']) ? 'active' : '');
            $this->htmlPage .= '<a class="nav-link '.$clase.'" href="'.$href.'"><div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">';
            $this->htmlPage .=  '<i class="'.$data['icon'].' text-dark " style="width: 12px;height: 12px;" aria-hidden="true"></i>';
            $this->htmlPage .=  '</div>';
            $this->htmlPage .=  '<span class="nav-link-text ms-1">'.$data['name'].'</span>';
            $this->htmlPage .= '</a>';
            $this->htmlPage .= '</li>';
        }

      
    }

    public function hijoPage($data){

        $href=url ($data['path']); 
        $clase =(Request::is($data['path']) ? 'active' : '');

        $this->htmlPage.='<li class="nav-item">';
        $this->htmlPage.=  '<a class="nav-link '.$clase.'" href="'.$href.'">';
        $this->htmlPage.=     '<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">';
        $this->htmlPage.=  '<i class="'.$data['icon'].' text-dark " style="width: 12px;height: 12px;" aria-hidden="true"></i>';
        $this->htmlPage.=    '</div>';
        $this->htmlPage.=    '    <span class="nav-link-text ms-1">'.$data['name'].'</span>';
        $this->htmlPage.=    ' </a>';
        $this->htmlPage.=    ' </li>';
        
        if(isset($data['subMenu'])){
            $this->recursivosTreePage($data['subMenu']);
        }
    }
}
