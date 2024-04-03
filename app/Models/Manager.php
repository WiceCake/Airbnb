<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username', 'password', 'fullname',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function getRememberToken()
    {
        $tokenRecord = DB::table('token_managers')
            ->where('user_id', $this->id)
            ->first();

        return $tokenRecord;
    }

    public function setRememberToken($value)
    {
        DB::table('token_managers')
            ->updateOrInsert(
                ['user_id' => $this->id],
                ['token' => $value]
            );
    }
}
