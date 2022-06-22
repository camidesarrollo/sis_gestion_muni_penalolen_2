<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vigencia;
use App\Models\Privilegios;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'name',
        'ap_paterno',
        'ap_materno',
        'run',
        'dv',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'rol_id',
        'vigencia_id'
    ];

    public function usertable()
    {
        return $this->morphTo();
    }

    public function vigencia()
    {
        return $this->hasOne(Vigencia::class);
    }

    public static function get($email){
        return User::where('email', '=', $email)->get();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
