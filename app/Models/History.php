<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';

    protected $table 		= 'histories';

    protected $fillable = [
        'id_usuario',
        'accion',
        'descripcion',
        'timestamps',
    ];

    public static function createHistory($data){
        $history = new History();
        $history->id_usuario = $data->id_usuario;
        $history->accion = $data->acción;
        $history->descripcion = $data->descripcion;
        $history->timestamps = $data->timestamps;
        $history->save();   
    }

}
