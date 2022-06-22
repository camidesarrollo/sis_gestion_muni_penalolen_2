<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolMenu extends Model
{
        
    protected $connection = 'sqlsrv';

    protected $table 		= 'rols_menu';

    use HasFactory;


    protected $fillable = [
        'id_role',
        'id_menu'
    ];

}
