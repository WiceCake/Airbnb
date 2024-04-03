<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $fillable = [
        'username', 'password',
        'fullname', 'registered_date',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function getRememberToken()
    {
        return $this->hasOne(TokenGuest::class, 'user_id');
    }

    public function setRememberToken($value)
    {
        DB::table('token_guests')
            ->updateOrInsert(
                ['user_id' => $this->id],
                ['token' => $value]
            );
    }

    static function getUser(){
        return static::query()->whereHas('getRememberToken', function($q){
            return $q->where('token', request()->bearerToken());
        })->first();
    }
}
