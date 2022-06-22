<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTablasGenerales extends Model
{

    protected $connection = 'sqlsrv_2';
    protected $table 		= 'GES_SUBTABLAS_GENERALES';
    use HasFactory;

    protected $fillable = [
        'cod_tabla',
        'cod_sub_tabla',
        'descripcion',
        'valor',
        'sw_vigencia',
        'valorchar'
    ];

}
