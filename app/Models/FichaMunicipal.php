<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaMunicipal extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_3';
    protected $table 		= 'FichaMunicipal';
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
