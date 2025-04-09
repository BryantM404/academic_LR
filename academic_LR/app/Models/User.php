<?php

namespace App\Models;

//-*use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'username', 'password', 'role_id'];
    protected $keyType = 'string';
    public $incrementing = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
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
