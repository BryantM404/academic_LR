<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'username',
        'password',
        'role_id',
    ];


    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'password' => 'hashed',
        ];
    }

    public function userRole() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function userMahasiswa(){
        return $this->hasOne(Mahasiswa::class);
    }

    public function userKaprodi(){
        return $this->hasOne(Kaprodi::class);
    }

    public function userTataUsaha(){
        return $this->hasOne(TataUsaha::class);
    }
}
