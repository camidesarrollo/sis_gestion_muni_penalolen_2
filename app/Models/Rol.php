<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vigencia;


class Rol extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id',
        'name',
        'vigencia_id',
        'privilegios_id',
    ];

    public function vigencia()
    {
        return $this->hasOne(Vigencia::class);
    }
}
