<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Privilegios extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    
    public $fillable = [
        'id',
        'escribir',
        'leer',
        'eliminar'
    ];

    public function usuarios()
    {
        return $this->morphMany(User::class, 'usertable');
    }
}
