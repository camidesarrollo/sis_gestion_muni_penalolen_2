<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
        
    protected $connection = 'sqlsrv';
    
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
