<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vigencia;

class Menu extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';

    protected $fillable = [
        'id',
        'name',
        'path',
        'padre',
        'orden',
        'icon',
        'descripcion',
        'vigencia_id',
    ];

    public function vigencia()
    {
        return $this->hasOne(Vigencia::class);
    }

    private  $lista_menuRole = [];
    

    public function MenuTreeRol( $menu) {
        $this->lista_menuRole = $menu;

        $arbol = $this->builTree();

        foreach ($arbol as $key => $val) {
            if($val['padre'] != 0){
                unset($arbol[$key]);
            }
        }
        $arbol = array_values($arbol);
        return $arbol;

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

}
